<?php

namespace App;

class Role
{
    // Constants representing different roles
    const SUPER_ADMIN = 999;          // Represents a super admin role
    const BRANCH_CHURCH_ADMIN = 889;  // Represents a branch church admin role
    const MEMBER = 1;

    // Constants representing different service unit roles
    const NEXUS_LEAD = 221;             // Represents a lead role in the Nexus service unit
    const GLORY_BROOK_LEAD = 222;       // Represents a lead role in the Glory Brook service unit
    const SANCTUARY_LEAD = 223;         // Represents a lead role in the Sanctuary service unit
    const GUIDING_LIGHT_LEAD = 224;     // Represents a lead role in the Guiding Light service unit
    const CHILDREN_CHURCH_LEAD = 225;   // Represents a lead role in the Children's Church service unit
    const PROTOCOL_LEAD = 226;          // Represents a lead role in the Protocol service unit
    const AMBIENCE_LEAD = 227;          // Represents a lead role in the Ambience service unit
    const LEAD_FOLLOW_UP = 228;         // Represents a lead follow-up role
    const FOLLOW_UP = 229;              // Represents a follow-up role
}
