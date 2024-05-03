<ul class="menu-inner py-1">
        <li class="menu-item {{ Route::currentRouteName() == 'follow_up_lead.analytics.metrics' ? 'active' : '' }}">
            <a href="{{ route('follow_up_lead.analytics.metrics') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div class="text-truncate" data-i18n="Email">Dashboard</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="app-chat.html" class="menu-link">
                <i class="menu-icon tf-icons bx bx-chat"></i>
                <div class="text-truncate" data-i18n="Chat">Call Log</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="app-calendar.html" class="menu-link">
                <i class="menu-icon tf-icons bx bx-calendar"></i>
                <div class="text-truncate" data-i18n="Calendar">Planned Outreach</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="app-kanban.html" class="menu-link">
                <i class="menu-icon tf-icons bx bx-grid"></i>
                <div class="text-truncate" data-i18n="Kanban">Follow Up Team</div>
            </a>
        </li>

        <li class="menu-item">
            <a href="{{ route('follow_up_lead.location.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-grid"></i>
                <div class="text-truncate" data-i18n="Kanban">Locations</div>
            </a>
        </li>


    </ul>
