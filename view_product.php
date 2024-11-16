<?php 
include "./include/header.php";

include '../db_connect.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $categoryId = intval($_GET['id']);

    // Fetch category details from the database using a prepared statement
    $itemQuery = "SELECT i.item_id , i.item_name, i.price, i.description, i.item_image, c.category_name 
                  FROM item i 
                  INNER JOIN category c ON i.category_id = c.category_id WHERE i.category_id = ? ORDER BY i.item_id DESC";
    
    // Prepare and bind parameters
    if ($stmt = $conn->prepare($itemQuery)) {
        $stmt->bind_param("i", $categoryId); // "i" indicates the parameter is an integer
        $stmt->execute();
        $itemResult = $stmt->get_result();

           // Fetch the category name if needed
    if ($categoryResult = $conn->prepare("SELECT category_name FROM category WHERE category_id = ?")) {
        $categoryResult->bind_param("i", $categoryId);
        $categoryResult->execute();
        $categoryResult->bind_result($categoryName);
        $categoryResult->fetch();  // This will fetch the category name based on the category ID
    }

    } else {
        echo "<p class='text-danger text-center'>Error with the query.</p>";
        exit();
    }

} else {
    echo "<p class='text-danger text-center'>Invalid category ID.</p>";
    exit();
}
?>


    <!-- Page Header Start -->
    <div class="container-fluid page-header py-6 wow fadeIn" data-wow-delay="0.1s">
        <div class="container text-center pt-5 pb-3">
            <h1 class="display-4 text-white animated slideInDown mb-3"><?= htmlspecialchars($categoryName) ?></h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a class="text-white" href="./index.php">Home</a></li>
                    <li class="breadcrumb-item"><a class="text-white" href="./product.php">Prodcut</a></li>
                    <li class="breadcrumb-item text-primary active" aria-current="page"><?= htmlspecialchars($categoryName) ?></li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

<!-- Product Start -->
<div class="container-xxl" style="margin-top: -2rem;">
    <div class="container">
        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
            <p class="text-primary text-uppercase mb-2"><?= htmlspecialchars($categoryName) ?></p>
            <h1 class="display-6 mb-4">Explore The Categories Of Our Cake <?= htmlspecialchars($categoryName) ?></h1>
        </div>

        <!-- Row for Team Members / Products -->
        <div class="row g-4 justify-content-center flex-wrap" style="margin-top: -3rem; margin-bottom: 2rem;"> <!-- Added flex-wrap -->
           
        <?php if ($itemResult->num_rows > 0): ?>
            <?php while ($row = $itemResult->fetch_assoc()): ?>

            <div class="col-lg-3 col-md-6 col-sm-12 wow fadeInUp mb-4" data-wow-delay="0.1s">
                <div class="team-item text-center rounded overflow-hidden">
                    <img class="img-fluid" src="data:image/*;base64,<?= $row['item_image'] ?>" alt="<?= htmlspecialchars($row['item_name']) ?>">
                    <div class="team-text">
                        <div class="team-title">
                            <h5><?= htmlspecialchars($row['item_name']) ?></h5>
                            <span><?= htmlspecialchars($row['price']) ?></span>
                        </div>
                        <div class="team-social">
                            <a class="btn btn-square btn-light rounded-circle" href="tel:+94786811063"><i class="fas fa-phone-alt"></i></a> <!-- Call Icon -->
                            <a class="btn btn-square btn-light rounded-circle" href="https://wa.me/94786811063" style="font-size: 24px;"><i class="fab fa-whatsapp"></i></a> <!-- Larger WhatsApp Icon -->
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
    <!-- End Row -->
    </div>
</div>
<!-- Team End -->

<?php 
include './include/footer.php';
?>