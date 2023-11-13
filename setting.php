<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>notes</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.rtl.min.css"
        integrity="sha384-gXt9imSW0VcJVHezoNQsP+TNrjYXoGcrqBZJpry9zJt8PCQjobwmhMGaDHTASo9N" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/styles.css">
</head>

<body>
    <div class="container-fluid min-vh-100 d-flex flex-column">
        <div class="row flex-grow-1">
            <div class="col-lg-2 col-md-3 sidebar">
                <h2 class="logo">یادداشت ها</h2>
                <div class="devider"></div>
                <div class="searchbox">
                    <form action="">
                        <a href="#"><i class="fas fa-magnifying-glass"></i></a>
                        <input type="text" placeholder="جستجو">
                    </form>
                </div>
                <ul id="menu">
                    <li class="menu-item"><a href="#"><i class="fas fa-home"></i>داشبورد</a></li>
                    <li class="menu-item"><a href="#"><i class="fas fa-book"></i>یادداشت ها</a></li>
                    <li class="menu-item"><a href="#"><i class="fas fa-wrench"></i>تنظیمات</a></li>
                    <li class="menu-item"><a href="#"><i class="fas fa-power-off"></i>خروج</a></li>
                </ul>

                <div class="upgrade">
                    <a href="#" class=""><i class="fas fa-trophy"></i>خرید نسخه کامل</a>
                </div>
            </div>
            <div class="col-lg-10 col-md-9 content g-0">
                <div class="bg">
                    <a class="profile"><i class="fas fa-user"></i>مشاهده پروفایل</a>
                    <div class="titles">
                        <h1 class="title">سلام مهدی</h1>
                        <h2 class="title">روزتو برنامه ریزی کن لذت ببر...</h2>
                    </div>
                </div>

                <div class="row mycards mx-auto notes">
                    <div class="col-lg-12">
                        <div class="box">
                            <h2><i class="fas fa-wrench"></i>تنظیمات</h2>
                            <form action="">
                            <div class="row p-4">
                                <div class="col-4"><input type="text" class="form-control" placeholder="نام شما"></div>
                                <div class="col-4"><input type="text" class="form-control" placeholder="عنوان اصلی"></div>
                                <div class="col-4"><input type="text" class="form-control" placeholder="عنوان فرعی"></div>
                            </div>
                            <input type="submit" class="btn btn-success ms-4" value="بروزرسانی"> 
                        </form>
                        </div>
                    </div>

                    
                </div>


            </div>
        </div>
    </div>


    <script src="scripts/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/js/all.min.js"
        integrity="sha512-naukR7I+Nk6gp7p5TMA4ycgfxaZBJ7MO5iC3Fp6ySQyKFHOGfpkSZkYVWV5R7u7cfAicxanwYQ5D1e17EfJcMA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>

</html>