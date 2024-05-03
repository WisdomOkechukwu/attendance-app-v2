<?php

namespace App;

class DashboardRoute
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public static function getHomePage($user){
        switch ($user->role) {
            case Role::SUPER_ADMIN:
                # code...
                break;

            case Role::BRANCH_CHURCH_ADMIN:
                # code...
                break;

            case Role::LEAD_FOLLOW_UP:
                return redirect()->route('follow_up_lead.analytics.metrics');
                break;

            case Role::FOLLOW_UP:

                break;

            case Role::NEXUS_LEAD:
                # code...
                break;

            case Role::GLORY_BROOK_LEAD:
                # code...
                break;

            case Role::SANCTUARY_LEAD:
                # code...
                break;

            case Role::GUIDING_LIGHT_LEAD:
                # code...
                break;

            case Role::CHILDREN_CHURCH_LEAD:
                # code...
                break;


            case Role::PROTOCOL_LEAD:
                # code...
                break;


            case Role::AMBIENCE_LEAD:
                # code...
                break;
            default:
                abort(404);
                break;
        }
    }

    public static function inspiration(){
        return [
            'christ in you the hope of glory, it time to bring forth glory',
            "Remember you are a royal priesthood, a holy nation, a people for God's own possession",
            "The kingdom of God is within you, let it manifest",
            "Arise and shine, for your light has come and the glory of the Lord is risen upon you",
            "Be strong and courageous, for the Lord your God is with you wherever you go",
            "Let your light shine before others, that they may see your good works and glorify your Father in heaven",
            "With God all things are possible, so step out in faith and watch Him move",
            "You are the salt of the earth and the light of the world, let your light shine",
            "The joy of the Lord is your strength, so rejoice in Him always",
            "Trust in the Lord with all your heart, and lean not on your own understanding",
            "For I know the plans I have for you, plans to prosper you and not to harm you, plans to give you a hope and a future",
            "Be still and know that I am God, I will be exalted among the nations, I will be exalted in the earth!",
            "Seek first the kingdom of God and His righteousness, and all these things shall be added to you",
            "With man this is impossible, but with God all things are possible",
            "I can do all things through Christ who strengthens me",
            "For we are God's workmanship, created in Christ Jesus to do good works",
            "Let your gentleness be evident to all. The Lord is near.",
            "Cast all your anxiety on him because he cares for you."
        ];
    }
}
