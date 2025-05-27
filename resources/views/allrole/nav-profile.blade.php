<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-md-12">
            <div class="nav-align-top">

                <ul class="nav nav-pills flex-column flex-md-row mb-6 gap-2 gap-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('users.accountSetting') ? 'active' : '' }}"
                            href="{{ route('users.accountSetting') }}">
                            <i class="ti-sm ti ti-users me-1_5"></i> Account
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('users.changePassword') ? 'active' : '' }}"
                            href="{{ route('users.changePassword') }}">
                            <i class="ti-sm ti ti-lock me-1_5"></i> Security
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="pages-account-settings-billing.html">
                            <i class="ti-sm ti ti-bookmark me-1_5"></i> Billing & Plans
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="pages-account-settings-notifications.html">
                            <i class="ti-sm ti ti-bell me-1_5"></i> Notifications
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="pages-account-settings-connections.html">
                            <i class="ti-sm ti ti-link me-1_5"></i> Connections
                        </a>
                    </li>
                </ul>

            </div>
            <div class="card mb-6">
