<div>
    <!-- ======= Sidebar ======= -->
        <aside id="sidebar" class="sidebar">
        
            <ul class="sidebar-nav" id="sidebar-nav">
        
                <li class="nav-item">
                    <a class="nav-link" href="{{route('dashboard')}}">
                        <i class="bi bi-grid"></i>
                        <span>Dashboard</span>
                    </a>
                </li><!-- End Dashboard Nav -->
        
                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                        <i class="bi bi-bank"></i><span>Budget Management</span><i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="{{route('bmrequest')}}">
                                <i class="bi bi-circle"></i><span>Requests List</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('bmallocation')}}">
                                <i class="bi bi-circle"></i><span>Budget Allocation</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('bmhistory')}}">
                                <i class="bi bi-circle"></i><span>History</span>
                            </a>
                        </li>
                    </ul>
                </li><!-- End Components Nav -->
        
                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
                        <i class="bi bi-journal-text"></i><span>Disbursement</span><i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="{{route('disburserequest')}}">
                                <i class="bi bi-circle"></i><span>Requests List</span>
                            </a>
                        </li>
                        
                    </ul>
                </li><!-- End Forms Nav -->
        
                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
                        <i class="bi bi-layout-text-window-reverse"></i><span>General Ledger</span><i
                            class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="{{route('generalchart')}}">
                                <i class="bi bi-circle"></i><span>Chart of Accounts</span>
                            </a>
                        </li>
                        <li>
                            <a href="tables-data.html">
                                <i class="bi bi-circle"></i><span>Journal Entry</span>
                            </a>
                        </li>
                    </ul>
                </li><!-- End Tables Nav -->
        
                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-target="#payables" data-bs-toggle="collapse" href="#">
                        <i class="bi bi-journal-minus"></i><span>Accounts Payable</span>
                    </a>
                </li><!-- End Charts Nav -->
                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-target="#icons-nav" href="{{route('recievables')}}">
                        <i class="bi bi-cash"></i><span>Accounts Recievables</span>
                    </a>
                </li><!-- End Charts Nav -->
        
                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-target="#icons-nav" href="{{route('collections')}}">
                        <i class="bi bi-cash"></i><span>Collections</span>
                    </a>
                </li><!-- End Icons Nav -->
        
            </ul>
        
        </aside><!-- End Sidebar-->
</div>
