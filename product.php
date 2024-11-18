<?php
$page = 'product';
include "./include/header.php";
?>


<!-- Page Header Start -->
<div class="container-fluid page-header py-6 wow fadeIn" data-wow-delay="0.1s">
    <div class="container text-center pt-5 pb-3">
        <h1 class="display-4 text-white animated slideInDown mb-3">Products</h1>
        <nav aria-label="breadcrumb animated slideInDown">
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a class="text-white" href="./index.php">Home</a></li>
                <li class="breadcrumb-item text-primary active" aria-current="page">Products</li>
            </ol>
        </nav>
    </div>
</div>
<!-- Page Header End -->


<!-- Product Start -->
<div class="container-xxl bg-light py-6 pt-0" style="margin-top: -6rem;">
    <div class="container">
        <div class="bg-primary text-light rounded-bottom p-5 my-6 mt-0 wow fadeInUp" data-wow-delay="0.1s">
            <div class="row g-4 align-items-center">
                <div class="col-lg-6">
                    <h1 class="display-4 text-light mb-0">The Best Cakes In Your City</h1>
                </div>
                <div class="col-lg-6 text-lg-end">
                    <div class="d-inline-flex align-items-center text-start">
                        <i class="fa fa-phone-alt fa-4x flex-shrink-0"></i>
                        <div class="ms-4">
                            <p class="fs-5 fw-bold mb-0">Call Us</p>
                            <p class="fs-1 fw-bold mb-0">+094 719651951</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
            <p class="text-primary text-uppercase mb-2">// Cake Products</p>
            <h1 class="display-6 mb-4">Explore The Categories Of Our Cake Products</h1>
        </div>
        <div class="row g-4">

            <?php
            // Include database connection
            include('./db_connect.php');

            // Fetch category data
            $categoryQuery = "SELECT * FROM category";
            $categoryResult = $conn->query($categoryQuery);
            ?>

            <?php if ($categoryResult->num_rows > 0): ?>
                <?php while ($row = $categoryResult->fetch_assoc()): ?>
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="product-item d-flex flex-column bg-white rounded overflow-hidden h-100">
                            <div class="text-center p-4">
                                <!-- Display price range dynamically -->
                                <div class="d-inline-block border border-primary rounded-pill px-3 mb-3">
                                    Rs. <?= htmlspecialchars($row['price_range']) ?>
                                </div>
                                <!-- Display category name dynamically -->
                                <h3 class="mb-3"><?= htmlspecialchars($row['category_name']) ?></h3>
                                <!-- Display description dynamically -->
                                <span><?= htmlspecialchars($row['description']) ?></span>
                            </div>
                            <div class="position-relative mt-auto">
                                <!-- Display image dynamically -->
                                <img class="img-fluid" src="data:image/*;base64,<?= $row['category_image'] ?>" alt="<?= htmlspecialchars($row['category_name']) ?>">
                                <div class="product-overlay">
                                    <!-- View button (you can link to details page here) -->
                                    <a class="btn btn-lg-square btn-outline-light rounded-circle" href="view_product.php?id=<?= $row['category_id'] ?>">
                                        <i class="fa fa-eye text-primary"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="col-12">
                    <p class="text-center">No categories found.</p>
                </div>
            <?php endif; ?>

        </div>
    </div>
</div>
<!-- Product End -->

<?php
include "./include/footer.php";
?>