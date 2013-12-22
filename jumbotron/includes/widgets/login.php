            <ul class="nav navbar-nav pull-right" style="padding-top:15px; padding-left: 5px;">
            <li class="dropdown"></li>
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Forgot? <b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li><a href="recover.php?mode=username">Username</a></li>
                <li class="divider"></li>
                <li><a href="recover.php?mode=password">Password</a></li>
              </ul>
            </li>
            </ul>
            <form action="login.php" method="post" class="navbar-form navbar-right">
            <div class="form-group">
              <input name="username" type="text" placeholder="Username" class="form-control">
            </div>
            <div class="form-group">
              <input name="password" type="password" placeholder="Password" class="form-control">
            </div>
            <button type="submit" class="btn btn-success">Sign in</button>
            <a href="register.php" class="btn btn-primary">Register</a>
            </form>