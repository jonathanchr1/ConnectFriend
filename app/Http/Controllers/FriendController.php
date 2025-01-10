<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\FriendRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FriendController extends Controller
{
    public function indexAll(Request $request)
    {
        $query = User::query();

        if ($request->has('search') && !empty($request->search)) {
            $keyword = $request->search;
            $query->where(function ($q) use ($keyword) {
                $q->where('field_of_work_interests', 'LIKE', "%$keyword%")
                ->orWhere('profession', 'LIKE', "%$keyword%");
            });
        }

        if ($request->has('gender') && !empty($request->gender)) {
            $query->where('gender', $request->gender);
        }

        $users = $query->paginate(6);

        return view('basepage', compact('users'));
    }

    public function index(Request $request)
    {
        $query = User::query();
        $query->where('id', '!=', auth()->id());

        if ($request->has('search') && !empty($request->search)) {
            $keyword = $request->search;
            $query->where(function ($q) use ($keyword) {
                $q->where('field_of_work_interests', 'LIKE', "%$keyword%")
                ->orWhere('profession', 'LIKE', "%$keyword%");
            });
        }

        if ($request->has('gender') && !empty($request->gender)) {
            $query->where('gender', $request->gender);
        }

        $users = $query->paginate(6);

        return view('friends.index', compact('users'));
    }

    public function show(User $user)
    {
        $currentUser = auth()->user();
        $isFriend = $currentUser->friends()->where('friend_id', $user->id)->exists();
        $hasSentRequest = $currentUser->sentFriendRequests()->where('receiver_id', $user->id)->exists();
        $hasReceivedRequest = $currentUser->receivedFriendRequests()->where('sender_id', $user->id)->exists();
        
        return view('friends.show', compact('user', 'isFriend', 'hasSentRequest', 'hasReceivedRequest'));
    }


    public function sendRequest(User $user)
    {
        FriendRequest::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $user->id,
        ]);

        return redirect()->back()->with('success', 'Friend request sent!');
    }

    public function list()
    {
        $user = Auth::user();

        $friends = $user->friends;
        $receivedRequests = FriendRequest::where('receiver_id', $user->id)->get();
        $sentRequests = FriendRequest::where('sender_id', $user->id)->get();

        return view('friends.list', compact('friends', 'receivedRequests', 'sentRequests'));
    }

    public function acceptRequest(FriendRequest $friendRequest)
    {
        $sender = $friendRequest->sender;
        $receiver = $friendRequest->receiver;

        if (!$sender || !$receiver) {
            return redirect()->back()->with('error', 'Invalid friend request.');
        }

        $receiver->friends()->attach($sender->id);
        $sender->friends()->attach($receiver->id);

        $friendRequest->delete();

        return redirect()->back()->with('success', 'Friend request accepted!');
    }

    public function rejectRequest(FriendRequest $friendRequest)
    {
        if (!$friendRequest) {
            return redirect()->back()->with('error', 'Friend request not found.');
        }

        $friendRequest->delete();

        return redirect()->back()->with('success', 'Friend request rejected.');
    }

    public function deleteFriend(User $user)
    {
        $currentUser = auth()->user();

        $currentUser->friends()->detach($user->id);
        $user->friends()->detach($currentUser->id);

        return redirect()->back()->with('success', 'Friend has been removed from your friend list.');
    }

}