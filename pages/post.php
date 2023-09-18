<?php
require_once('C:\laragon\www\Blogy\config\database.php');
include_once('C:\laragon\www\Blogy\classes\Post.php');
session_start();
include('C:\laragon\www\Blogy\includes\header.php');
include('C:\laragon\www\Blogy\includes\navbar.php');

$postobj = new POST($pdo);

$post =[];
  if ($postobj->readOne($_GET['id'])) {

        $post = $postobj->readOne($_GET['id']);}
//}

if (isset($_POST['delete_post'])) {
    $postobj->id = $_GET['id'];
    if ($postobj->delete()) {
        header('Location: home.php');
    }
}

?>
    <header class="masthead" style="background-image: url('../assets/img/post-bg.jpg')">
        <div class="container position-relative px-4 px-lg-5">

            <?php if($_SESSION['user_id']==$post['author_id']) {?>
                <form method="post">
                    <button class="btn" type="submit" name="delete_post"><i class="fas fa-trash text-white fs-3"></i></button>
                </form>
                <a href=<?= "edit_post.php?id=" . $_GET['id'] ?> class="btn" type="submit"><iclass="fas fa-edit text-white fs-3"></i></a>
            <?php }?>
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="post-heading">
                    <h2>
                        <?php
                        if (isset($post['title'])) :
                            echo $post['title'];
                        endif
                        ?>
                    </h2>

                    <span class="meta">

                    Posted by
                    <a href="#!">
                        <?php
                        if (isset($post['author_name'])) :
                            echo $post['author_name'];
                        endif
                        ?>
                    </a>
                    <?php
                    if ($post) :
                        echo $post['created_at'];
                    endif
                    ?>
                </span>
                </div>
            </div>
    </header>
    <!-- Post Content-->
    <article class="mb-4">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <p>
                        <?php if ($post) : ?>
                    <div class="content-box">
                        <?php echo $post['content']; ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </article>

<?php
include('C:\laragon\www\Blogy\includes\footer.php');
?>