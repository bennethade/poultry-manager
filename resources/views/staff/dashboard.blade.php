@extends('layouts.app')

@section('content')


    <style>
        body {
            font-family: Arial, sans-serif;
            background: #ffffff;
        }

        .container {
            width: 100%;
            margin: 10px auto;
        }

        .section {
            margin-bottom: 20px;
            border: 2px solid #8c0783;
            border-radius: 6px;
            overflow: hidden;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 14px 20px;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            background: #fff;
        }

        .chevron {
            font-size: 18px;
            transition: transform 0.3s ease;
        }

        .section-body {
            padding: 15px;
            transition: max-height 0.4s ease;
        }

        .section.collapsed .section-body {
            display: none;
        }

        .section.collapsed .chevron {
            transform: rotate(-90deg);
        }

        /* Cards */
        .card-grid {
            display: grid;
            gap: 20px;
        }

        .card {
            text-align: center;
            cursor: pointer;
        }

        .card img {
            width: 100%;
            height: 100%;
            border-radius: 4px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.15);
        }

        .card p {
            margin-top: 10px;
            font-size: 14px;
        }

      .card-link {
            text-decoration: none;
            color: black;
            display: block;
        }

        .card-link:hover {
            text-decoration: none;
            color: inherit;
        }


      /* Desktop (default) */
        @media (min-width: 1200px) {
            .card-grid {
                grid-template-columns: repeat(5, 1fr);
            }
        }

        /* Tablet */
        @media (min-width: 768px) and (max-width: 1199px) {
            .card-grid {
                grid-template-columns: repeat(4, 1fr);
            }
        }

        /* Mobile */
        @media (max-width: 767px) {
            .card {
                height: 130px;
            }

            .card img {
                max-width: 100px;
                max-height: 80px;
            }
            
            .card-grid {
                grid-template-columns: repeat(3, 1fr);
            }

            .card p {
                margin-top: 10px;
                font-size: 12px;
            }

            .card-grid {
                display: grid;
                gap: 8px;
            }

            .section-body {
                padding: 5px;
                transition: max-height 0.4s ease;
            }

            .section-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 12px 20px;
                font-size: 16px;
                font-weight: bold;
                cursor: pointer;
                background: #fff;
            }
        }

    </style>




  @if (isApprovedUser())

    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2 align-items-center">
                    <div class="col-sm-6">
                        {{-- <h4 class="m-0">Dashboard</h4> --}}
                    </div>

                    <div class="col-sm-6 text-right">
                        <h4 class="m-0">
                            My Tasks:
                            <span class="badge badge-danger">
                                <a href="{{ route('staff.tasks.index') }}" style="color: white;">
                                    {{ $pendingTasksCount }}
                                </a>
                            </span>
                        </h4>
                    </div>
                </div>
            </div>
        </div>

      

        <div class="container">

            <!-- Animal Record Section -->
            <div class="section">
                <div class="section-header" onclick="toggleSection(this)">
                    <span>Animal Record</span>
                    <span class="chevron">&#9662;</span>
                </div>

                <div class="section-body">
                    <div class="card-grid">

                        <a href="{{ url('staff/animal_record/animal_identification/list') }}" style="color: black; display: block">
                            <div class="card">
                                <img src="{{ asset('upload/icons/identity.png') }}" alt="">
                                <p>Animal Identification</p>
                            </div>
                        </a>

                        <a href="{{ url('staff/animal_record/breeding_record/list') }}" style="color: black; display: block">
                            <div class="card">
                                <img src="{{ asset('upload/icons/poultry.png') }}" alt="">
                                <p>Breeding Record</p>
                            </div>
                        </a>

                        <a href="{{ url('staff/animal_record/growth_performance/list') }}" style="color: black; display: block">
                            <div class="card">
                                <img src="{{ asset('upload/icons/plant.png') }}" alt="">
                                <p>Growth & Performance</p>
                            </div>
                        </a>

                        <a href="{{ url('staff/animal_record/inactive_animal/list') }}" style="color: black; display: block">
                            <div class="card">
                                <img src="{{ asset('upload/icons/hibernation.png') }}" alt="">
                                <p>Inactive Animals</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>


            
            <!--  GENERAL FARM ACTIVITIES RECORD Section -->
            <div class="section">
                <div class="section-header" onclick="toggleSection(this)">
                    <span>General Farm Activities</span>
                    <span class="chevron">&#9662;</span>
                </div>

                <div class="section-body"> 
                    <div class="card-grid">
                        <a href="{{ url('/staff/general_farm_activity/farm_daily_care/list') }}" style="color: black; display: block">
                            <div class="card">
                                <img src="{{ asset('upload/icons/farmer.png') }}" alt="">
                                <p>Daily Farm Activity</p>
                            </div>
                        </a>

                        <a href="{{ url('staff/general_farm_activity/maintenance_sanitation/list') }}" style="color: black; display: block">
                            <div class="card">
                                <img src="{{ asset('upload/icons/tea.png') }}" alt="">
                                <p>Maintenance & Sanitation</p>
                            </div>
                        </a>

                        <a href="{{ url('staff/tasks/pending_in_progress') }}" style="color: black; display: block">
                            <div class="card">
                                <img src="{{ asset('upload/icons/calendar.png') }}" alt="">
                                <p>My Task Schedule</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Feed Record Section -->
            <div class="section">
                <div class="section-header" onclick="toggleSection(this)">
                    <span>Feed Record</span>
                    <span class="chevron">&#9662;</span>
                </div>

                <div class="section-body">
                    <div class="card-grid">
                        <a href="{{ url('staff/feed_record/feed_stock/list') }}" style="color: black; display: block">
                            <div class="card">
                                <img src="{{ asset('upload/icons/inventory-list.png') }}" alt="">
                                <p>Feed Stock Record</p>
                            </div>
                        </a>

                        <a href="{{ url('staff/feed_record/daily_feed_usage/list') }}" style="color: black; display: block">
                            <div class="card">
                                <img src="{{ asset('upload/icons/animal-feed.png') }}" alt="">
                                <p>Daily Feed Usage</p>
                            </div>
                        </a>

                        <a href="{{ url('staff/feed_record/feed_formulation/list') }}" style="color: black; display: block">
                            <div class="card">
                                <img src="{{ asset('upload/icons/diet.png') }}" alt="">
                                <p>Feed Formulation</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>



            <!--  EVENT MANAGEMENT RECORD Section -->
            <div class="section">
                <div class="section-header" onclick="toggleSection(this)">
                    <span>Event Management</span>
                    <span class="chevron">&#9662;</span>
                </div>

                <div class="section-body"> 
                    <div class="card-grid">
                        <a href="{{ url('staff/tasks/pending_in_progress') }}" style="color: black; display: block">
                            <div class="card">
                                <img src="{{ asset('upload/icons/to-do-list.png') }}" alt="">
                                <p>My Pending Tasks</p>
                            </div>
                        </a>

                        <a href="{{ url('staff/tasks/completed') }}" style="color: black; display: block">
                            <div class="card">
                                <img src="{{ asset('upload/icons/planning.png') }}" alt="">
                                <p>My Completed Tasks</p>
                            </div>
                        </a>

                        {{-- <a href="{{ url('staff/tasks/my_todo') }}" style="color: black; display: block">
                            <div class="card">
                                <img src="{{ asset('upload/icons/to-do-list.png') }}" alt="">
                                <p>My To-Do</p>
                            </div>
                        </a> --}}
                    </div>
                </div>
            </div>


            <!-- Expense RECORD Section -->
            <div class="section">
                <div class="section-header" onclick="toggleSection(this)">
                    <span>Expense Record</span>
                    <span class="chevron">&#9662;</span>
                </div>

                <div class="section-body">
                    <div class="card-grid">
                        <a href="{{ url('staff/expense_record/daily_expense/list') }}" style="color: black; display: block">
                            <div class="card">
                                <img src="{{ asset('upload/icons/spending.png') }}" alt="">
                                <p>Daily Expense Record</p>
                            </div>
                        </a>

                        
                        <a href="{{ url('staff/expense_record/monthly_expense_summary/list') }}" style="color: black; display: block">
                            <div class="card">
                                <img src="{{ asset('upload/icons/budget-2.png') }}" alt="">
                                <p>Monthly Expense Summary</p>
                            </div>
                        </a>

                    </div>
                </div>
            </div>
            
            
            <!-- Sales RECORD Section -->
            <div class="section">
                <div class="section-header" onclick="toggleSection(this)">
                    <span>Sales & Disposal Record</span>
                    <span class="chevron">&#9662;</span>
                </div>

                <div class="section-body">
                    <div class="card-grid">
                        <a href="{{ url('staff/sales_record/daily_sales/list') }}" style="color: black; display: block">
                            <div class="card">
                                <img src="{{ asset('upload/icons/earnings.png') }}" alt="">
                                <p>Daily Sales/Disposal </p>
                            </div>
                        </a>

                        
                        <a href="{{ url('staff/sales_record/monthly_sales_summary/list') }}" style="color: black; display: block">
                            <div class="card">
                                <img src="{{ asset('upload/icons/acquisition.png') }}" alt="">
                                <p>Monthly Sales Summary</p>
                            </div>
                        </a>

                    </div>
                </div>
            </div>



            {{-- FARM INVENTORY SECTION --}}
            <div class="section">
                <div class="section-header" onclick="toggleSection(this)">
                    <span>Inventory Record</span>
                    <span class="chevron">&#9662;</span>
                </div>

                <div class="section-body"> 
                    <div class="card-grid">
                        <a href="{{ url('staff/inventory/farm_inventory/list') }}" style="color: black; display: block">
                            <div class="card">
                                <img src="{{ asset('upload/icons/inventory.png') }}" alt="">
                                <p>Farm Inventory</p>
                            </div>
                        </a>

                        <a href="{{ url('staff/inventory/miscellaneous/list') }}" style="color: black; display: block">
                            <div class="card">
                                <img src="{{ asset('upload/icons/material-management.png') }}" alt="">
                                <p>Miscellaneous Record</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>




            <!--    DISEASE & TREATMENT RECORD Section -->
            <div class="section">
                <div class="section-header" onclick="toggleSection(this)">
                    <span>Disease & Treatment Record</span>
                    <span class="chevron">&#9662;</span>
                </div>

                <div class="section-body">
                    <div class="card-grid">
                        <a href="{{ url('staff/disease_treatment/disease_incidence/list') }}" style="color: black; display: block">
                            <div class="card">
                                <img src="{{ asset('upload/icons/virus.png') }}" alt="">
                                <p>Disease Incidence Record</p>
                            </div>
                        </a>

                        <a href="{{ url('staff/disease_treatment/medication_treatment/list') }}" style="color: black; display: block">
                            <div class="card">
                                <img src="{{ asset('upload/icons/syringe.png') }}" alt="">
                                <p>Medication & Treatment</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
           
           
           
            <!--    VACCINE RECORD Section -->
            <div class="section">
                <div class="section-header" onclick="toggleSection(this)">
                    <span>Vaccine Record</span>
                    <span class="chevron">&#9662;</span>
                </div>

                <div class="section-body">
                    <div class="card-grid">
                        <a href="{{ url('staff/vaccine_record/vaccine_schedule/list') }}" style="color: black; display: block">
                            <div class="card">
                                <img src="{{ asset('upload/icons/syringe-2.png') }}" alt="">
                                <p>Vaccine Schedule</p>
                            </div>
                        </a>

                        <a href="{{ url('staff/vaccine_record/vaccine_log/list') }}" style="color: black; display: block">
                            <div class="card">
                                <img src="{{ asset('upload/icons/vaccine-log.png') }}" alt="">
                                <p>Farm-Wide Vaccine Log</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

        </div>

        <script>

        function toggleSection(header) {
            const section = header.parentElement;
            section.classList.toggle('collapsed');
        }

        </script>
    </div>





    

  @else

    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-12">
              <div class="alert alert-danger border-0 bg-danger alert-dismissible fade show">
                <strong>Your account is inactive! Please contact the staff for activation.</strong>
              </div>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
    </div>
  @endif





@endsection