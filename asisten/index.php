<?php
    session_start();
    include_once '../assets/conn/dbconnect.php';
   
    if(!isset($_SESSION['assistantSession']))
    {
        // header("Location: ../index.php");
    }

    $usersession = $_SESSION['assistantSession'];
    $res = mysqli_query($con,"SELECT * FROM asisten WHERE asistenNRP=".$usersession);
    $userRow  = mysqli_fetch_array($res, MYSQLI_ASSOC);

    //ADD SCHEDULEs
    if(isset($_POST['submit'])) {
        $tanggal = mysqli_real_escape_string($con, $_POST['tanggal']);
        $hari = mysqli_real_escape_string($con, $_POST['hari']);
        $mulai = mysqli_real_escape_string($con, $_POST['mulai']); 
        $selesai = mysqli_real_escape_string($con, $_POST['selesai']);
        $status = mysqli_real_escape_string($con, $_POST['status']);
        $nrp = mysqli_real_escape_string($con, $userRow['asistenNRP']);

        $query = "INSERT INTO jadwalasisten (asistenNRP, jadwalTanggal, jadwalHari, mulai, selesai,  status ) 
        VALUES ('$nrp', '$tanggal', '$hari','$mulai', '$selesai', '$status')";

        $result = mysqli_query($con, $query);

        if($result){
            ?>
            <script type="text/javascript">
                alert('Success');
            </script>
            <?php
        }else{
            ?>
            <script type="text/javascript">
                alert('Failed');
            </script>
            <?php
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-dark sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="mx-auto mb-4 mt-4" href="index.php">
                <div class="sidebar-header mx-auto">
                    <img src="img/logo.png" class="img-fluid" style="width: 150px; display:block">   
                </div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Tambah Jadwal</span></a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="tables.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Jadwal Asistensi</span></a>
            </li>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Components</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Components:</h6>
                        <a class="collapse-item" href="profile.php">Profile</a>
                        <a class="collapse-item" href="asistenlogout.php">Log Out</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        
                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Halo, <?php echo $userRow['asistenNama'];?></span>
                                <img class="img-profile rounded-circle"
                                src="img/<?php echo $userRow['asistenPic'];?>" style="object-fit: cover;">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="profile.php">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Tambah Jadwal</h1>
                    </div>

                    <!-- Content Row -->

                    <div class="row">
                        <!-- Area Chart -->
                        <div class="col-xl-12 col-lg-8">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Masukkan jadwal</h6>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink">
                                            <div class="dropdown-header">Dropdown Header:</div>
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <form action="<?php $_PHP_SELF ?>" method="POST" accept-charset="utf-8" class="form" role="form">
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="tanggal">Tanggal :</label>
                                                    <input class="form-control" id="tanggal" name="tanggal" type="date" required/>
                                                </div>
                            
                                                <div class="form-group col-md-6">
                                                    <label for="hari">Hari :</label>
                                                    <select class="select form-control" id="hari" name="hari" required>
                                                        <option value="Monday">Monday</option>
                                                        <option value="Tuesday">Tuesday</option>
                                                        <option value="Wednesday">Wednesday</option>
                                                        <option value="Thursday">Thursday</option>
                                                        <option value="Friday">Friday</option>
                                                        <option value="Saturday">Saturday</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="mulai">Mulai :</label>
                                                    <input class="form-control" type="time" id="mulai" name="mulai" required>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="selesai">Selesai :</label>
                                                    <input class="form-control" type="time" id="selesai" name="selesai" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-2 requiredField" for="status">Availabilty</label>
                                                <select class="select form-control" id="status" name="status" required>
                                                    <option value="Available">Available</option>
                                                    <option value="Not Available">Not Available</option>
                                                </select>
                                            </div>
                                            <!-- <div class="form-group">
                                                <label class="control-label col-sm-2 requiredField" for="nrp">NRP</label>
                                                <input class="form-control" type="text" id="nrp" name="nrp" value="<?php echo $userRow['asistenNRP'];?>" required>
                                            </div> -->
                                            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Content Column -->
                        <div class="col-xl-12 col-lg-8 mb-4">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead class="thead-dark">
                                        <tr>
                                        <th class='text-center' scope="col">Tanggal</th>
                                        <th class='text-center' scope="col">Hari</th>
                                        <th class='text-center' scope="col">Mulai</th>
                                        <th class='text-center' scope="col">Selesai</th>
                                        <th class='text-center' scope="col">Status</th>
                                        <th class='text-center' scope="col">Action</th>
                                    </tr>
                                    </thead>
                                    <?php
                                $result = mysqli_query($con, "SELECT * FROM jadwalasisten where asistenNRP =".$usersession);
                                
                                while($jadwalasisten = mysqli_fetch_array($result)){
                                    echo "<tbody>";
                                        echo "<tr class='text-center'>";
                                        // echo "<td>" . $assistantschedule['asistenNRP'] . "</td>";
                                        echo "<td>" . $jadwalasisten['jadwalTanggal'] . "</td>";
                                            echo "<td class='text-center'>" . $jadwalasisten['jadwalHari'] . "</td>";
                                            echo "<td class='text-center'>" . $jadwalasisten['mulai'] . "</td>";
                                            echo "<td class='text-center'>" . $jadwalasisten['selesai'] . "</td>";
                                            echo "<td class='text-center'>" . $jadwalasisten['status'] . "</td>";
                                            echo "<form method='POST'>";
                                            echo "<td class='text-center'><a href='#' id='".$jadwalasisten['id']."'class='delete'><i class='fas fa-trash' style='color:#292b2c;'></i></a>
                                            </td>";     
                                        } 
                                        echo "</tr>";
                                        echo "</tbody>";
                                        
                                        echo "</table>";
                                        // echo "<div class='panel panel-default'>";
                                        //     echo "<div class='col-md-offset-3 pull-right'>";
                                        //         echo "<button class='btn btn-primary' type='submit' value='Submit' name='submit'>Update</button>";
                                        //     echo "</div>";
                                        // echo "</div>";
                                        ?>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; B401 </span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.php?logout">Logout</a>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
    <script src="js/index.js"></script>

</body>

</html>