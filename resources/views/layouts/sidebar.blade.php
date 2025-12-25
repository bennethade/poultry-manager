{{-- Sidebar --}}
<aside class="main-sidebar sidebar-dark-warning elevation-4">
   <!-- Brand Logo -->
   <a href="{{ route('login') }}" class="brand-link" style="text-align: center;">
      <span>
         {{ env('APP_NAME') }}
      </span>
   </a>
   <!-- Sidebar -->
   <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
         <div class="image">
            <img src="{{ Auth::user()->getProfileDirect() }}" class="img-circle elevation-2" alt="{{ Auth::user()->name }}">
            
         </div>
         <div class="info">
            <a href="{{ route('login') }}" class="d-block">{{ Auth::user()->name }}</a>
         </div>
      </div>
      <!-- Sidebar Menu -->

      @if (isApprovedUser())
         <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
               
               
               {{-- SIDEBAR FOR SUPER ADMIN --}}
               @if (Auth::user()->user_type == 1 || Auth::user()->user_type == 'Super Admin')
                  <li class="nav-item">
                     <a href="{{ url('admin/dashboard') }}" class="nav-link @if(Request::segment(2) == 'dashboard') active @endif">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                           Dashboard
                        </p>
                     </a>
                  </li>
                  
                  <!--<li class="nav-item">-->
                  <!--   <a href="{{ url('admin/admin/list') }}" class="nav-link @if(Request::segment(2) == 'admin') active @endif">-->
                  <!--      <i class="nav-icon fas fa-user-shield"></i>-->
                  <!--      <p>-->
                  <!--         Admin-->
                  <!--      </p>-->
                  <!--   </a>-->
                  <!--</li>-->

                  <li class="nav-item">
                     <a href="{{ url('admin/designation/list') }}"
                        class="nav-link @if(Request::segment(2) == 'designation') active @endif">
                        <i class="nav-icon fas fa-user-tie"></i>
                        <p>
                           Designation
                        </p>
                     </a>
                  </li>


                  <li class="nav-item">
                     <a href="{{ url('admin/staff/list') }}"
                        class="nav-link @if(Request::segment(2) == 'staff') active @endif">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                           Staff Records
                        </p>
                     </a>
                  </li>

                  <li class="nav-item">
                     <a href="{{ url('admin/view_records/list') }}"
                        class="nav-link @if(Request::segment(2) == 'view_records') active @endif">
                        <i class="nav-icon fas fa-folder"></i>
                        <p>
                           Weekly Records
                        </p>
                     </a>
                  </li>


                  <li class="nav-item @if(Request::segment(2) == 'animal_record') menu-is-opening menu-open @endif">
                     <a href="#" class="nav-link @if(Request::segment(2) == 'animal_record') active @endif">
                        <i class="nav-icon fas fa-dollar-sign"></i>
                        <p>
                           Animal Record
                           <i class="fas fa-angle-left right"></i>
                        </p>
                     </a>
                     <ul class="nav nav-treeview">
                        <li class="nav-item">
                           <a href="{{ url('admin/animal_record/animal_identification/list') }}"
                              class="nav-link @if(Request::segment(3) == 'animal_identification') active @endif">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Animal Identification</p>
                           </a>
                        </li>
                        <li class="nav-item">
                           <a href="{{ url('admin/animal_record/breeding_record/list') }}"
                              class="nav-link @if(Request::segment(3) == 'breeding_record') active @endif">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Breeding Record</p>
                           </a>
                        </li>

                        <li class="nav-item">
                           <a href="{{ url('admin/animal_record/growth_performance/list') }}"
                              class="nav-link @if(Request::segment(3) == 'growth_performance') active @endif">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Growth & Performance</p>
                           </a>
                        </li>
                     </ul>
                  </li>


                  <li class="nav-item @if(Request::segment(2) == 'feed_record') menu-is-opening menu-open @endif">
                     <a href="#" class="nav-link @if(Request::segment(2) == 'feed_record') active @endif">
                        <i class="nav-icon fas fa-clipboard-list"></i>
                        <p>
                           Feed Record
                           <i class="fas fas fa-angle-left right"></i>
                        </p>
                     </a>
                     <ul class="nav nav-treeview">
                        <li class="nav-item">
                           <a href="{{ url('admin/feed_record/feed_stock/list') }}"
                              class="nav-link @if(Request::segment(3) == 'feed_stock') active @endif">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Feed Stock</p>
                           </a>
                        </li>
                        <li class="nav-item">
                           <a href="{{ url('admin/feed_record/daily_feed_usage/list') }}"
                              class="nav-link @if(Request::segment(3) == 'daily_feed_usage') active @endif">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Daily Feed Usage</p>
                           </a>
                        </li>

                        <li class="nav-item">
                           <a href="{{ url('admin/feed_record/feed_formulation/list') }}"
                              class="nav-link @if(Request::segment(3) == 'feed_formulation') active @endif">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Feed Formulation</p>
                           </a>
                        </li>
                     </ul>
                  </li>
                  
                  
                  <li class="nav-item @if(Request::segment(2) == 'expense_record') menu-is-opening menu-open @endif">
                     <a href="#" class="nav-link @if(Request::segment(2) == 'expense_record') active @endif">
                        <i class="nav-icon fas fa-clipboard-list"></i>
                        <p>
                           Expense Record
                           <i class="fas fas fa-angle-left right"></i>
                        </p>
                     </a>
                     <ul class="nav nav-treeview">
                        <li class="nav-item">
                           <a href="{{ url('admin/expense_record/daily_expense/list') }}"
                              class="nav-link @if(Request::segment(3) == 'daily_expense') active @endif">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Daily Expense Record</p>
                           </a>
                        </li>
                        
                        <li class="nav-item">
                           <a href="{{ url('admin/expense_record/monthly_expense_summary/list') }}"
                              class="nav-link @if(Request::segment(3) == 'monthly_expense_summary') active @endif">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Monthly Summary</p>
                           </a>
                        </li>

                        <li class="nav-item">
                           <a href="{{ url('admin/expense_record/weekly_expense_summary/list') }}"
                              class="nav-link @if(Request::segment(3) == 'weekly_expense_summary') active @endif">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Expense Report</p>
                           </a>
                        </li>
                     </ul>
                  </li>


                  <li class="nav-item @if(Request::segment(2) == 'sales_record') menu-is-opening menu-open @endif">
                     <a href="#" class="nav-link @if(Request::segment(2) == 'sales_record') active @endif">
                        <i class="nav-icon fas fa-clipboard-list"></i>
                        <p>
                           Sales Record
                           <i class="fas fas fa-angle-left right"></i>
                        </p>
                     </a>
                     <ul class="nav nav-treeview">
                        <li class="nav-item">
                           <a href="{{ url('admin/sales_record/daily_sales/list') }}"
                              class="nav-link @if(Request::segment(3) == 'daily_sales') active @endif">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Daily Sales Record</p>
                           </a>
                        </li>
                        
                        <li class="nav-item">
                           <a href="{{ url('admin/sales_record/monthly_sales_summary/list') }}"
                              class="nav-link @if(Request::segment(3) == 'monthly_sales_summary') active @endif">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Monthly Summary</p>
                           </a>
                        </li>

                        <li class="nav-item">
                           <a href="{{ url('admin/sales_record/weekly_sales_summary/list') }}"
                              class="nav-link @if(Request::segment(3) == 'weekly_sales_summary') active @endif">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Sales Report</p>
                           </a>
                        </li>
                     </ul>
                  </li>

                  
                  {{-- <li class="nav-item">
                     <a href="{{ url('admin/expenses/list') }}"
                        class="nav-link @if(Request::segment(2) == 'expenses') active @endif">
                        <i class="nav-icon fas fa-coins"></i>
                        <p>
                           Expenses
                        </p>
                     </a>
                  </li> --}}


                  {{-- <li class="nav-item">
                     <a href="{{ url('admin/farm_record/list') }}"
                        class="nav-link @if(Request::segment(2) == 'farm_record') active @endif">
                        <i class="nav-icon fas fa-clipboard-list"></i>
                        <p>
                           Farm Records
                        </p>
                     </a>
                  </li> --}}


                  <li class="nav-item">
                     <a href="{{ url('admin/farm_daily_care/list') }}"
                        class="nav-link @if(Request::segment(2) == 'farm_daily_care') active @endif">
                        <i class="nav-icon fas fa-hand-holding-water"></i>
                        <p>
                           Farm Daily Care
                        </p>
                     </a>
                  </li>

                  


                  <li class="nav-item">
                     <a href="{{ url('admin/sales/list') }}"
                        class="nav-link @if(Request::segment(2) == 'sales') active @endif">
                        <i class="nav-icon fas fa-chart-line"></i>
                        <p>
                           Sales
                        </p>
                     </a>
                  </li>


                  <li class="nav-item">
                     <a href="{{ url('admin/miscellaneous/list') }}"
                        class="nav-link @if(Request::segment(2) == 'miscellaneous') active @endif">
                        <i class="nav-icon fas fa-folder-open"></i>
                        <p>
                           Miscellaneous Records
                        </p>
                     </a>
                  </li>

                  <li class="nav-item">
                     <a href="{{ url('admin/report/list') }}"
                        class="nav-link @if(Request::segment(2) == 'report') active @endif">
                        <i class="nav-icon fas fa-file-alt"></i>
                        <p>
                           Reports
                        </p>
                     </a>
                  </li>
                  
                  <li class="nav-item">
                     <a href="{{ url('admin/setting') }}" class="nav-link @if(Request::segment(2) == 'setting') active @endif">
                        <i class="nav-icon fas fa-cogs"></i>
                        <p>
                           Setting
                        </p>
                     </a>
                  </li>

                  <li class="nav-item">
                     <a href="{{ url('admin/account') }}" class="nav-link @if(Request::segment(2) == 'account') active @endif">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                           My Account
                        </p>
                     </a>
                  </li>
                  
                  <li class="nav-item">
                     <a href="{{ url('admin/change_password') }}"
                        class="nav-link @if(Request::segment(2) == 'change_password') active @endif">
                        <i class="nav-icon fas fa-key"></i>
                        <p>
                           Change Password
                        </p>
                     </a>
                  </li>




               {{-- SIDEBAR FOR FARM ADMIN--}}
               @elseif (Auth::user()->user_type == 'Company Admin')
                  <li class="nav-item">
                     <a href="{{ url('admin/dashboard') }}" class="nav-link @if(Request::segment(2) == 'dashboard') active @endif">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                           Dashboard
                        </p>
                     </a>
                  </li>
                  
                  <li class="nav-item">
                     <a href="{{ url('admin/designation/list') }}"
                        class="nav-link @if(Request::segment(2) == 'designation') active @endif">
                        <i class="nav-icon fas fa-user-tie"></i>
                        <p>
                           Designation
                        </p>
                     </a>
                  </li>


                  <li class="nav-item">
                     <a href="{{ url('admin/staff/list') }}"
                        class="nav-link @if(Request::segment(2) == 'staff') active @endif">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                           Staff Records
                        </p>
                     </a>
                  </li>


                  <li class="nav-item">
                     <a href="{{ url('admin/farm_record/list') }}"
                        class="nav-link @if(Request::segment(2) == 'farm_record') active @endif">
                        <i class="nav-icon fas fa-clipboard-list"></i>
                        <p>
                           Farm Records
                        </p>
                     </a>
                  </li>


                  <li class="nav-item">
                     <a href="{{ url('admin/farm_daily_care/list') }}"
                        class="nav-link @if(Request::segment(2) == 'farm_daily_care') active @endif">
                        <i class="nav-icon fas fa-hand-holding-water"></i>
                        <p>
                           Farm Daily Care
                        </p>
                     </a>
                  </li>

                  <li class="nav-item">
                     <a href="{{ url('admin/expenses/list') }}"
                        class="nav-link @if(Request::segment(2) == 'expenses') active @endif">
                        <i class="nav-icon fas fa-coins"></i>
                        <p>
                           Expenses
                        </p>
                     </a>
                  </li>


                  <li class="nav-item">
                     <a href="{{ url('admin/sales/list') }}"
                        class="nav-link @if(Request::segment(2) == 'sales') active @endif">
                        <i class="nav-icon fas fa-chart-line"></i>
                        <p>
                           Sales
                        </p>
                     </a>
                  </li>


                  <li class="nav-item">
                     <a href="{{ url('admin/miscellaneous/list') }}"
                        class="nav-link @if(Request::segment(2) == 'miscellaneous') active @endif">
                        <i class="nav-icon fas fa-folder-open"></i>
                        <p>
                           Miscellaneous Records
                        </p>
                     </a>
                  </li>

                  <li class="nav-item">
                     <a href="{{ url('admin/report/list') }}"
                        class="nav-link @if(Request::segment(2) == 'report') active @endif">
                        <i class="nav-icon fas fa-file-alt"></i>
                        <p>
                           Reports
                        </p>
                     </a>
                  </li>
                  
                  <li class="nav-item">
                     <a href="{{ url('admin/setting') }}" class="nav-link @if(Request::segment(2) == 'setting') active @endif">
                        <i class="nav-icon fas fa-cogs"></i>
                        <p>
                           Setting
                        </p>
                     </a>
                  </li>

                  <li class="nav-item">
                     <a href="{{ url('admin/account') }}" class="nav-link @if(Request::segment(2) == 'account') active @endif">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                           My Account
                        </p>
                     </a>
                  </li>

                  <li class="nav-item">
                     <a href="{{ url('admin/change_password') }}"
                        class="nav-link @if(Request::segment(2) == 'change_password') active @endif">
                        <i class="nav-icon fas fa-key"></i>
                        <p>
                           Change Password
                        </p>
                     </a>
                  </li>



                  
                     
               


               {{-- SIDEBAR FOR STAFF --}}
               @elseif (Auth::user()->user_type == 2)
                  <li class="nav-item">
                     <a href="{{ url('staff/dashboard') }}"
                        class="nav-link @if(Request::segment(2) == 'dashboard') active @endif">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                           Dashboard
                        </p>
                     </a>
                  </li>

                  <li class="nav-item">
                     <a href="{{ url('staff/farm_record/list') }}"
                        class="nav-link @if(Request::segment(2) == 'farm_record') active @endif">
                        <i class="nav-icon fas fa-clipboard-list"></i>
                        <p>
                           Farm Records
                        </p>
                     </a>
                  </li>


                  <li class="nav-item">
                     <a href="{{ url('staff/farm_daily_care/list') }}"
                        class="nav-link @if(Request::segment(2) == 'farm_daily_care') active @endif">
                        <i class="nav-icon fas fa-hand-holding-water"></i>
                        <p>
                           Farm Daily Care
                        </p>
                     </a>
                  </li>

                  <li class="nav-item">
                     <a href="{{ url('staff/expenses/list') }}"
                        class="nav-link @if(Request::segment(2) == 'expenses') active @endif">
                        <i class="nav-icon fas fa-coins"></i>
                        <p>
                           Expenses
                        </p>
                     </a>
                  </li>


                  <li class="nav-item">
                     <a href="{{ url('staff/sales/list') }}"
                        class="nav-link @if(Request::segment(2) == 'sales') active @endif">
                        <i class="nav-icon fas fa-chart-line"></i>
                        <p>
                           Sales
                        </p>
                     </a>
                  </li>


                  <li class="nav-item">
                     <a href="{{ url('staff/miscellaneous/list') }}"
                        class="nav-link @if(Request::segment(2) == 'miscellaneous') active @endif">
                        <i class="nav-icon fas fa-folder-open"></i>
                        <p>
                           Miscellaneous Records
                        </p>
                     </a>
                  </li>
                  
                  <li class="nav-item">
                     <a href="{{ url('staff/account') }}" class="nav-link @if(Request::segment(2) == 'account') active @endif">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                           My Account
                        </p>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="{{ url('staff/change_password') }}"
                        class="nav-link @if(Request::segment(2) == 'change_password') active @endif">
                        <i class="nav-icon fas fa-key"></i>
                        <p>
                           Change Password
                        </p>
                     </a>
                  </li>



               @endif
               <li class="nav-item">
                  <a href="{{ route('logout') }}" class="nav-link">
                     <i class="nav-icon fas fa-sign-out-alt"></i>
                     <p>
                        Logout
                     </p>
                  </a>
               </li>
               ...
            </ul>
         </nav>
      @endif
      
   </div>
</aside>