<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Steam Footer - Bootstrap</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .steam-footer {
      background-color: #171a21;
      color: #c6d4df;
      font-size: 14px;
      padding: 30px 0;
    }

    .steam-footer a {
      color: #c6d4df;
      text-decoration: none;
    }

    .steam-footer a:hover {
      text-decoration: underline;
    }

    .footer-logo {
      width: 120px;
    }

    .footer-bottom {
      font-size: 12px;
      color: #8f98a0;
      margin-top: 20px;
    }
  </style>
</head>
<body>

  <footer class="footer pt-2" >
    <div class="container" style="background-color: #171a21;color: #c6d4df;">
      <div class="row align-items-center mb-4" >
        <div class="col-md-2 text-center text-md-start mb-3 mb-md-0" style="padding-top: 10px; padding-left: 50px;">
          <img src="https://store.cloudflare.steamstatic.com/public/shared/images/header/logo_steam.svg?t=962016" alt="Steam Logo" class="footer-logo">
        </div>
        <div class="col-md-7 text-center text-md-start">
          <div class="d-flex flex-wrap justify-content-center justify-content-md-start gap-2">
            
            <a href="#"class="nav-item nav-link"style="padding-left:250px">Giới thiệu</a>
            <a href="#"class="nav-item nav-link"style="padding-left:20px">Liên hệ</a>
            <a href="#"class="nav-item nav-link"style="padding-left:20px">Hỗ trợ</a>
            <a href="#"class="nav-item nav-link"style="padding-left:20px">Việc làm</a>
                               
          </div>

          
        </div>
        
         
        
        <div class="col-md-3 text-center text-md-end">
          <div>Ngôn ngữ: <strong>Tiếng Việt</strong></div>
          <div>Quốc gia: <strong>Việt Nam</strong></div>
           <div>
            <div>Chúng tôi có mặt trên:</div>
            <a href="#"><img src="https://img.icons8.com/color/48/000000/facebook-new.png" alt="Facebook" width="24"></a>
            <a href="#"><img src="https://img.icons8.com/color/48/000000/twitter--v1.png" alt="Twitter" width="24"></a>
            <a href="#"><img src="https://img.icons8.com/color/48/000000/instagram-new.png" alt="Instagram" width="24"></a>
          </div>  
        </div>
      </div>
      
      <div class="row">
        <div class="col-md-12 text-center">
          <p>Chúng tôi cam kết bảo mật thông tin cá nhân của bạn. Đọc thêm về <a href="#">Chính sách bảo mật</a>.</p>
        </div>
      <div class="row">
        <div class="col-md-12 text-center">
          <p>© 2023 Game Store. Bản quyền thuộc về Game Store Team 19.</p>
        </div>

      <!-- <div class="footer-bottom text-center" style="background-color: #1b1e24;color white;">
        © Game Store 19. Mọi quyền được bảo lưu. Tất cả các thương hiệu là tài sản của chủ sở hữu tương ứng tại Mỹ và các quốc gia khác.
      </div> -->
    </div>
  </footer>

  <!-- Bootstrap JS (tuỳ chọn nếu bạn cần dropdown, collapse, modal...) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
