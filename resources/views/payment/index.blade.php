@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Payment for Registration</h2>
    <p>Registration Fee: <strong>{{ $registrationFee }}</strong></p>

    <form id="payment-form">
        @csrf
        <input type="hidden" id="registration_fee" value="{{ $registrationFee }}">
        <div class="form-group">
            <label for="payment_amount">Enter Payment Amount:</label>
            <input type="number" id="payment_amount" class="form-control" required>
        </div>
        <br>
        <button type="button" id="submit-payment" class="btn btn-primary">Submit Payment</button>
    </form>

    <div id="payment-alert" class="mt-4" style="display: none;">
        <div id="alert-message" class="alert"></div>
        <button id="yes-btn" class="btn btn-success" style="display: none;">Yes</button>
        <button id="no-btn" class="btn btn-danger" style="display: none;">No</button>
    </div>
</div>

<script>
document.getElementById('submit-payment').addEventListener('click', function () {
    const paymentAmount = document.getElementById('payment_amount').value;
    const csrfToken = document.querySelector('input[name="_token"]').value;

    fetch('/payment', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
        },
        body: JSON.stringify({ payment_amount: paymentAmount }),
    })
    .then(response => response.json())
    .then(data => {
        const alertDiv = document.getElementById('payment-alert');
        const alertMessage = document.getElementById('alert-message');
        const yesBtn = document.getElementById('yes-btn');
        const noBtn = document.getElementById('no-btn');

        alertDiv.style.display = 'block';
        yesBtn.style.display = 'none';
        noBtn.style.display = 'none';

        if (data.status === 'underpaid') {
            alertMessage.className = 'alert alert-danger';
            alertMessage.textContent = data.message;
        } else if (data.status === 'overpaid') {
            alertMessage.className = 'alert alert-warning';
            alertMessage.textContent = data.message;

            yesBtn.style.display = 'inline-block';
            noBtn.style.display = 'inline-block';

            yesBtn.onclick = () => {
                fetch('/payment/confirm-overpayment', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    body: JSON.stringify({ overpaid: data.overpaid }),
                })
                .then(response => response.json())
                .then(result => {
                    alertMessage.className = 'alert alert-success';
                    alertMessage.textContent = result.message;
                    yesBtn.style.display = 'none';
                    noBtn.style.display = 'none';
                    window.location.href = '/home';
                });
            };

            noBtn.onclick = () => {
                alertDiv.style.display = 'none';
                document.getElementById('payment_amount').value = '';
            };
        } else if (data.status === 'success') {
            alertMessage.className = 'alert alert-success';
            alertMessage.textContent = data.message;
            setTimeout(() => {
                window.location.href = '/home';
            }, 2000);
        }
    });
});
</script>
@endsection
