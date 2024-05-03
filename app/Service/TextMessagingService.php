<?php

namespace App\Service;

use App\Models\TextMessageGroup;
use App\Models\TextMessageGroupMember;
use Illuminate\Support\Facades\DB;

class TextMessagingService
{
    public function show_text_message_group()
    {
        $admin = auth()->user();

        return TextMessageGroup::where('status','active')
            ->where('branch_state_id',$admin->branch_state_id)
            ->where('branch_location_id',$admin->branch_location_id)
            ->get();
    }

    public function create_text_message_group($name)
    {
        DB::transaction(function () use ($name) {
            $admin = auth()->user();

            $text_message_groups = new TextMessageGroup();
            $text_message_groups->name = $name;
            $text_message_groups->status = 'active';
            $text_message_groups->branch_location_id = $admin->branch_location_id;
            $text_message_groups->branch_state_id = $admin->branch_state_id;
            $text_message_groups->save();
        });
    }

    public function add_contacts_to_group($text_message_group_id, $user_id)
    {
        DB::transaction(function () use ($text_message_group_id, $user_id) {
            $text_message_group_member = new TextMessageGroupMember();
            $text_message_group_member->text_message_group_id = $text_message_group_id;
            $text_message_group_member->user_id = $user_id;
            $text_message_group_member->save();
        });
    }

    public function remove_contacts_from_group($text_message_group_id, $user_id)
    {
        DB::transaction(function () use ($text_message_group_id, $user_id) {
            $user = TextMessageGroupMember::where('user_id',$user_id)
                ->where('text_message_group_id',$text_message_group_id)
                ->first();

            $user->delete();
        });
    }

    public function convert_contacts_to_string()
    {
        //? ongoing
    }

    public function delete_text_message_group($text_message_group_id)
    {
        DB::transaction(function () use ($text_message_group_id) {
            $group = TextMessageGroup::where('text_message_group_id',$text_message_group_id)->first();
            $group->status = 'in-active';
            $group->save();
        });
    }
}
