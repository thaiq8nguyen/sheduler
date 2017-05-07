<header class = "navbar navbar-default navbar-static-top">
    <div class = "container">
        <div class = "navbar-header">
            <a href = "/" class = "navbar-brand">Sugar Nails</a>
            <button class = "navbar-toggle" type = "button" data-toggle = "collapse" data-target = "#navbar-main">
                <span class = "icon-bar"></span>
                <span class = "icon-bar"></span>
                <span class = "icon-bar"></span>
            </button>
        </div>
        <div class = "navbar-collapse collapse" id = "navbar-main">
            <ul class = "nav navbar-nav fa-ul">
                <li><a href = " {{ url('/appointments/create') }}">Make Appointments</a></li>
            </ul>
        </div>
    </div>
</header>