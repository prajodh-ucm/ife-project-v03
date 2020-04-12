<!--  HTML fragment to be used on all pages -->
<!DOCTYPE html>
		<nav class="navbar navbar-expand-lg navbar-light bg-light headerNav">
		  <div class="navbar-brand" >Student Notebook</div>
		  
		  <div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto">
			  <li class="nav-item active">
				<a class="nav-link" href="#">Home </a>
			  </li>
			  <li class="nav-item">
				<a class="nav-link" href="#">Course / Classes Setup</a>
			  </li>
			  <li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				  Subject Notes
				</a>
				<div class="dropdown-menu" aria-labelledby="navbarDropdown">
				<!-- TODO: ADD PHP LOGIC to dynamically pull the dropdown list -->
				  <a class="dropdown-item" href="#">Advanced analysis & design</a>
				  <a class="dropdown-item" href="#">Managing information security in organizations</a>
				  <a class="dropdown-item" href="#">Advanced Java programming</a>
				  <a class="dropdown-item" href="#">Internet for the interprise</a>
				</div>
			  </li>
			  <li class="nav-item">
				<a class="nav-link" href="puzzles.php">Feeling Free</a>
			  </li>	
			</ul>
			<form class="form-inline my-2" action="./home.php" method="post">
			  <input class="form-control mr-sm-2" name="userInput"  type="search" placeholder="Enter your userid" aria-label="Search">
			  <button class="btn btn-outline-success" name="submit" type="submit">Enter</button>
			</form>
		  </div>
		</nav>
		
	
