<?php
    session_start();
    include 'connect.php';

    if(!isset($_SESSION['user_role'])) {
        header('location: /laundry_system/homepage/homepage.php');
        exit();
    }

    $user_role = $_SESSION['user_role'];

    if ($_SESSION['user_role'] !== 'admin') {
        header('location: /laundry_system/homepage/homepage.php');
        exit();
    } 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings - Configuration of Wash/Dry/Press</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="edit2.css">
</head>

<body>
    <div class="progress"></div>

    <div class="wrapper">
        <aside id="sidebar">
            <div class="d-flex">
                <button id="toggle-btn" type="button">
                    <i class="bx bx-menu-alt-left"></i>
                </button>

                <div class="sidebar-logo">
                    <a href="/laundry_system/dashboard/dashboard.php">Azia Skye</a>
                </div>
            </div>

             <ul class="sidebar-nav">
                <li class="sidebar-item">
                    <a href="/laundry_system/dashboard/dashboard.php" class="sidebar-link">
                        <i class="lni lni-grid-alt"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a href="/laundry_system/profile/profile.php" class="sidebar-link">
                        <i class="lni lni-user"></i>
                        <span>Profile</span>
                    </a>
                </li>

                <?php if ($user_role === 'admin') : ?>
                <li class="sidebar-item">
                    <a href="/laundry_system/users/users.php" class="sidebar-link">
                        <i class="lni lni-users"></i>
                        <span>Users</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a href="/laundry_system/records/customer.php" class="sidebar-link has-dropdown collapsed" data-bs-toggle="collapse" data-bs-target="#records" aria-expanded="false" aria-controls="records">
                        <i class="lni lni-files"></i>
                        <span>Records</span>
                    </a>

                    <ul id="records" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="/laundry_system/records/customer.php" class="sidebar-link">Customer</a>
                        </li>

                        <li class="sidebar-item">
                            <a href="/laundry_system/records/service.php" class="sidebar-link">Service</a>
                        </li>

                        <li class="sidebar-item">
                            <a href="/laundry_system/records/category.php" class="sidebar-link">Category</a>
                        </li>
                        </ul>
                </li>
                <?php endif; ?>

                <li class="sidebar-item">
                    <a href="/laundry_system/transaction/transaction.php" class="sidebar-link">
                        <i class="lni lni-coin"></i>
                        <span>Transaction</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a href="/laundry_system/sales_report/report.php" class="sidebar-link">
                        <i class='bx bx-line-chart'></i>
                        <span>Sales Report</span>
                    </a>
                </li>

                <?php if ($user_role === 'admin') : ?>
                <li class="sidebar-item">
                    <a href="/laundry_system/settings/setting.php" class="sidebar-link">
                        <i class="lni lni-cog"></i>
                        <span>Settings</span>
                    </a>
                </li>

                <hr style="border: 1px solid #b8c1ec; margin: 8px">

                <li class="sidebar-item">
                    <a href="/laundry_system/archived/archive_users.php" class="sidebar-link">
                        <i class='bx bxs-archive-in'></i>
                        <span class="nav-item">Archived</span>
                    </a>
                </li>
                <?php endif; ?>      
            </ul>

             <div class="sidebar-footer">
                <a href="javascript:void(0)" class="sidebar-link" id="btn_logout">
                    <i class="lni lni-exit"></i>
                    <span>Logout</span>
                </a>
            </div>
        </aside>
        
        <?php
        // Database connection
            $conn = new mysqli('localhost', 'root', '', 'laundry_db');

            if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
            }

            if (isset($_POST['submit'])) {
            $service_id = $_POST['service_id'];
            $price = $_POST['prices'];
            $category_id = $_POST['category_id']; 

            // Update the price for the specific category and service
            $sql = "UPDATE service_category_price 
            SET price = '$price' 
            WHERE category_id = '$category_id' AND service_id = '$service_id'";

            $result = $conn->query($sql); 
            // Customize Prompt MEeeessageeeeee
            if ($result) {
                echo "<script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Price has been updated successfully!',
                        background: '#f0f8ff', // Custom background color
                        color: '#333', // Custom text color
                        confirmButtonColor: '#3085d6', // Custom button color
                        confirmButtonText: 'OK',
                        showCloseButton: true, // Show close button
                        animation: true, // Enable animation
                        timer: 30000, // Show for 30 seconds
                        willOpen: () => {
                            const modal = Swal.getHtmlContainer();
                            if (modal) {
                                modal.style.width = '500px'; // Set custom width
                                modal.style.height = '60px'; // Set height to auto for dynamic content
                                modal.style.maxWidth = '100%'; // Set max width for responsiveness
                            } 
                        }
                    });
                </script>";
            } else {
                echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Error updating price!',
                        text: 'Something went wrong. Please try again.',
                    });
                </script>";
            }
        }
    ?>

        <!-------------MAIN CONTENT------------->
        <div class="main-content">
            <nav>
                <div class="d-flex justify-content-between align-items-center">
                    <h1>Settings</h1>
                </div>
                <div class="text" style="text-align: center;" name="category">
                    <h2>Update Price</h2>
                </div>
            </nav>

            <div class="table-responsive">
                <table class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th scope="col">Category Option</th>
                            <th scope="col">Service Option</th>
                            <th scope="col">Prices</th>
                            <th scope="col">Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT c.laundry_category_option, s.laundry_service_option, scp.price, scp.category_id, s.service_id
                                FROM service_category_price scp
                                JOIN service s ON scp.service_id = s.service_id
                                JOIN category c ON scp.category_id = c.category_id
                                WHERE scp.service_id = 2";

                        $result = mysqli_query($conn, $sql);
                        if (!$result) {
                            die("Query Failed: " . mysqli_error($conn));
                        }

                        while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                            <tr>
                                
                                <td><?php echo htmlspecialchars($row["laundry_category_option"]); ?></td>
                                <td><?php echo htmlspecialchars($row["laundry_service_option"]); ?></td>
                                <td><?php echo htmlspecialchars($row["price"]); ?></td>
                                <td>
                                    <a href="javascript:void(0);" class="edit-btn" 
                                        data-id="<?php echo htmlspecialchars($row['service_id']); ?>" 
                                        data-option="<?php echo htmlspecialchars($row['laundry_category_option']); ?>"
                                        data-price="<?php echo htmlspecialchars($row['price']); ?>"
                                        data-category-id="<?php echo htmlspecialchars($row['category_id']); ?>">
                                        <i class="bx bxs-edit"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>

            <!-- Edit form -->
            <div class="form-popup" id="editForm" style="display:none;">
                <form method="POST">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4>Edit Category Option</h4>
                            <span class="close">&times;</span>
                        </div>   

                        <div class="modal-body">
                            <div class="form-group">
                                <input type="hidden" id="service_id" name="service_id">
                                <input type="hidden" id="category_id" name="category_id">
                            </div>
                            
                            <div class="form-group">
                                <label for="laundry_category_option">Category Option:</label>
                                <input type="text" class="form-control" id="laundry_category_option" name="laundry_category_option" readonly>
                            </div>
                            
                            <div class="form-group">
                                <label for="price">Price:</label>
                                <input type="text" class="form-control" id="price" name="prices" required>
                            </div>
                            
                            <div class="button-container">
                                <button type="submit" class="btn btn-success" name="submit">Submit</button>
                                <button type="button" class="btn btn-danger" id="cancelButton">Cancel</button>
                            </div>
                        </div>
                    </div>
                </form>    
            </div> 
        </div>
    </div>
</body>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="editt2.js"></script>
</html>