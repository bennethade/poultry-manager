<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    
    <!-- LEFT: Menu toggle -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                <i class="fas fa-bars"></i>
            </a>
        </li>
    </ul>

    <!-- CENTER: Tasks badge -->
    <ul class="navbar-nav mx-auto">
        <li class="nav-item">
            <span class="badge task-flag">
                @if (Auth::user()->user_type == 1)
                    <a href="{{ route('tasks.index') }}" class="text-dark">
                        {{ getAllPendingTasks() }}
                    </a>
                @else
                    <a href="{{ route('staff.tasks.index') }}" class="text-dark">
                        {{ getUserPendingTasks() }}
                    </a>
                @endif
            </span>

        </li>
    </ul>

    <!-- RIGHT: Motto -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <span class="navbar-text text-primary mobile">
                What was not recorded did not happen!
            </span>
        </li>
    </ul>

</nav>


<style>
@media (max-width: 767px) {
    .mobile {
        font-size: 12px;
        text-align: center;
        display: block;
        white-space: normal;
    }
}


/* Flying flag style */
.task-flag {
    position: relative;
    background: linear-gradient(135deg, #facc15, #fde047);
    color: #000;
    padding: 5px 10px;
    font-size: 14px;
    font-weight: 600;
    border-radius: 4px 0 0 4px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
    transform: rotate(-2deg);
}

/* Flag tail */
.task-flag::after {
    content: "";
    position: absolute;
    top: 0;
    right: -14px;
    width: 0;
    height: 0;
    border-top: 10px solid transparent;
    border-bottom: 14px solid transparent;
    border-left: 14px solid #fde047;
}

/* Link cleanup */
.task-flag a {
    text-decoration: none;
}

/* Hover effect */
.task-flag:hover {
    transform: rotate(0deg) translateY(-2px);
    transition: all 0.3s ease;
}
</style>

