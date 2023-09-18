<?php
session_start();
include('C:\laragon\www\Blogy\includes\header.php');
include('C:\laragon\www\Blogy\includes\navbar.php');

require_once('C:\laragon\www\Blogy\classes\user.php');
require_once('C:\laragon\www\Blogy\config\database.php');


if(isset($_SESSION['user_id']))
{

    header('Location: home.php');
    exit;
}

if($_POST && isset($_POST['login']) &&  isset($_POST['email']) &&  isset($_POST['password']))
{

    $email = ($_POST['email']);
    $password = ($_POST['password']);
    $user = new User($pdo);
    $resuilt = $user->login($email ,$password );

    if($resuilt===true)
    {
        header('Location: home.php');
        exit;
    }
    else
    {

        $error = $resuilt;
    }

}


?>
    <section class="text-center">
        <div class="p-5 bg-image" style="
        background-image: url('https://mdbootstrap.com/img/new/textures/full/171.jpg');
        height: 300px;
        "></div>


        <div class="card mx-4 mx-md-5 shadow-5-strong" style="
        margin-top: -100px;
        background: hsla(0, 0%, 100%, 0.8);
        backdrop-filter: blur(30px);
        ">
            <div class="card-body py-5 px-md-5">

                <div class="row d-flex justify-content-center">
                    <div class="col-lg-8">
                        <h2 class="fw-bold mb-5">Sign in</h2>
                        <?php if (isset($error)): ?>
                            <div class="alert alert-danger">
                                <ul>
                                    <li><?= $error ?></li>
                                </ul>
                            </div>
                        <?php endif ?>
                        <form method="post">
                            <div class="form-outline mb-4">
                                <label class="form-label" for="form3Example3">Email address</label>
                                <input name="email" type="email" id="form3Example3" class="form-control" />
                            </div>

                            <div class="form-outline mb-4">
                                <label class="form-label" for="form3Example4">Password</label>
                                <input name="password" type="password" id="form3Example4" class="form-control" />
                            </div>

                            <button name="login" type="submit" class="btn btn-primary btn-block mb-4">
                                Sign in
                            </button>

                            <div class="text-center">
                                <a href="C:\laragon\www\Blogy\pages\register.php">or sign up</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>


<?php
include('C:\laragon\www\Blogy\includes\footer.php')
?>