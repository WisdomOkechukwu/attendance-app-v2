<?php

namespace App\Service;

use App\Models\DiscipleshipClassHistory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MemberService
{
    /**
     * Retrieve a paginated list of members.
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function list_of_members(): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        // Retrieve users with simple pagination (1000 items per page)
        return User::simplePaginate(1000);
    }

    /**
     * Show details of a specific user.
     *
     * @param int $id User ID
     * @return \App\Models\User
     */
    public function show_user($id): \App\Models\User
    {
        // Find a user by ID or throw an exception if not found
        return User::findOrFail($id);
    }

    /**
     * Update details of a user based on the provided request data.
     *
     * @param \Illuminate\Http\Request $request
     * @return void
     */
    public function update_user(Request $request): void
    {
        // Use a database transaction to ensure atomicity
        DB::transaction(function () use ($request) {
            // Find the user by ID or throw an exception if not found
            $user = User::findOrFail($request->id);

            // Update user attributes based on the request data
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->wa_phone = $request->wa_phone;
            $user->address = $request->address;
            $user->location = $request->location;
            $user->role = $request->role;
            $user->dob = $request->dob;
            $user->service_unit_id = $request->service_unit_id;
            $user->discipleship_class_id = $request->discipleship_class_id;
            $user->save();

            if($user->discipleship_class_id != $request->discipleship_class_id)
            {
                $discipleshipLog = new DiscipleshipClassHistory();
                $discipleshipLog->discipleship_class_id = $request->discipleship_class_id;
                $discipleshipLog->user_id = $user->id;
                $discipleshipLog->save();
            }
        });
    }

    /**
     * Delete a user based on the provided request data.
     *
     * @param \Illuminate\Http\Request $request
     * @return void
     */
    public function destroy_user(Request $request): void
    {
        // Find the user by ID or throw an exception if not found
        $user = User::findOrFail($request->id);

        // Delete the user
        $user->delete();
    }
}
