 <!-- ======= Sidebar ======= -->
 <aside id="sidebar" class="sidebar">

   <section class="section profile">
     <div class="row">
       <div class="col-xl-12">

         <div class="card-body profile-card pt-1 d-flex flex-column align-items-center">

           <img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle mb-1">
           <h3>AntoNiX</h3>
         </div>

       </div>
     </div>
   </section>

   <ul class="sidebar-nav" id="sidebar-nav">

  <li class="nav-item">
    <a class="nav-link <?php if ($currentPage === 'dashboard') echo 'active'; ?>" href="addpost.php">
      <i class="bi bi-house"></i>
      <span>Home</span>
    </a>
  </li>

  <li class="nav-item">
    <a class="nav-link collapsed <?php if ($currentPage === 'department') echo 'active'; ?>" href="add-department.php">
      <i class="bi bi-journal"></i>
      <span>Past Questions</span>
    </a>
  </li>

  <li class="nav-item">
    <a class="nav-link collapsed <?php if ($currentPage === 'level') echo 'active'; ?>" href="addlevel.php">
      <i class="bi bi-building"></i>
      <span>Departments</span>
    </a>
  </li>

  <li class="nav-item">
    <a class="nav-link collapsed <?php if ($currentPage === 'pq') echo 'active'; ?>" href="addpq.php">
      <i class="bi bi-book"></i>
      <span>Solve & Earn coming soon!</span>
    </a>
  </li>

  <li class="nav-item">
    <a class="nav-link collapsed <?php if ($currentPage === 'project') echo 'active'; ?>" href="addproject.php">
      <i class="bi bi-graph-up"></i>
      <span>Analytics</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link collapsed <?php if ($currentPage === 'project') echo 'active'; ?>" href="addproject.php">
      <i class="bi bi-graph-up"></i>
      <span>About</span>
    </a>
  </li>
</ul>




 </aside><!-- End Sidebar-->