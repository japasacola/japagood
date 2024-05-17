<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

include 'components/wishlist_cart.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>grapelauncher</title>

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<div class="home-bg">
 
<section class="home">

   <div class="swiper home-slider">
   
   <div class="swiper-wrapper">

      <div class="swiper-slide slide">
         <div class="image">
            <img src="https://cdn.discordapp.com/attachments/1106688945577787445/1240759387295977472/Imagem_do_WhatsApp_de_2024-05-16_as_17.11.26_1b52cf6a.jpg?ex=6647baba&is=6646693a&hm=d87d9e2c44e38617b8359f2087e585351a90d7849e86cb7f014056b8597198df&" alt="">
         </div>
         <div class="content">
            <span></span>
                <h3>O melhor do Launcher </h3>
            
         </div>
      </div>

      <div class="swiper-slide slide">
         <div class="image">
            <img src="https://media.discordapp.net/attachments/1106688945577787445/1240759387744632852/Imagem_do_WhatsApp_de_2024-05-16_as_17.11.26_1353be75.jpg?ex=6647baba&is=6646693a&hm=3cc9441368cbd9412d84e135e56d5a91d4ece2b619e09183f5bc81c5f37c262d&=&format=webp&width=1202&height=676" alt="">
         </div>
         <div class="content">
            <span></span>
            <h3>Por um preço Super Barato </h3>
            
         </div>
      </div>

      <div class="swiper-slide slide">
         <div class="image">
            <img src="https://media.discordapp.net/attachments/1106688945577787445/1240759388029980822/Imagem_do_WhatsApp_de_2024-05-16_as_17.11.26_3600482f.jpg?ex=6647baba&is=6646693a&hm=f57689120ec4b485da7308de836424affc6ed5c52687b3ca4f69c7ef5a14d792&=&format=webp&width=1202&height=676" alt="">
         </div>
         <div class="content">
            <span>Super Combo </span>
            <h3>Launcher mais Minecraft </h3>
            
         </div>
      </div>

   

</section>

<section class="home-products">

  

   <div class="swiper products-slider">

   <div class="swiper-wrapper">

   <?php
     $select_products = $conn->prepare("SELECT * FROM `products` LIMIT 6"); 
     $select_products->execute();
     if($select_products->rowCount() > 0){
      while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
   ?>
   <form action="" method="post" class="swiper-slide slide">
      <input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>">
      <input type="hidden" name="name" value="<?= $fetch_product['name']; ?>">
      <input type="hidden" name="price" value="<?= $fetch_product['price']; ?>">
      <input type="hidden" name="image" value="<?= $fetch_product['image_01']; ?>">
      <button class="fas fa-heart" type="submit" name="add_to_wishlist"></button>
      <a href="quick_view.php?pid=<?= $fetch_product['id']; ?>" class="fas fa-eye"></a>
      <img src="uploaded_img/<?= $fetch_product['image_01']; ?>" alt="">
      <div class="name"><?= $fetch_product['name']; ?></div>
      <div class="flex">
         <div class="price"><span>Nrs.</span><?= $fetch_product['price']; ?><span>/-</span></div>
         <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1">
      </div>
      <input type="submit" value="add to cart" class="btn" name="add_to_cart">
   </form>
   <?php
      }
   }else{
      echo '<p class="empty">no products added yet!</p>';
   }
   ?>

   </div>

   <div class="swiper-pagination"></div>

   </div>

</section>









<?php include 'components/footer.php'; ?>

<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

<script src="js/script.js"></script>

<script>

var swiper = new Swiper(".home-slider", {
   loop:true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
    },
});

 var swiper = new Swiper(".category-slider", {
   loop:true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
   breakpoints: {
      0: {
         slidesPerView: 2,
       },
      650: {
        slidesPerView: 3,
      },
      768: {
        slidesPerView: 4,
      },
      1024: {
        slidesPerView: 5,
      },
   },
});

var swiper = new Swiper(".products-slider", {
   loop:true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
   breakpoints: {
      550: {
        slidesPerView: 2,
      },
      768: {
        slidesPerView: 2,
      },
      1024: {
        slidesPerView: 3,
      },
   },
});

</script>

</body>
</html>