<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/x-icon" href="<?php echo base_url($pengaturan->url_logo_kecil) ?>">
  <title><?php echo strtoupper($pengaturan->singkatan) ?></title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    body {
      background: linear-gradient(135deg, #8fa8b7 0%, #b3ddf7 100%);
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 20px;
      background-image: url('./_asset/img/bg_3.png');
      background-size: cover;
      background-position: center;
    }

    .container {
      width: 100%;
      max-width: 400px;
      position: relative;
    }

    .login-card {
      background: rgba(255, 255, 255, 0.25);
      backdrop-filter: blur(10px);
      -webkit-backdrop-filter: blur(10px);
      border-radius: 20px;
      border: 1px solid rgba(255, 255, 255, 0.18);
      padding: 40px 30px;
      box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.15);
      text-align: center;
      color: #333;
      position: relative;
      overflow: hidden;
    }

    .login-card::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: linear-gradient(135deg, rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0.05));
      z-index: -1;
    }

    .logo {
      margin-bottom: 30px;
    }

    .logo img {
      font-size: 50px;
      color: #0288d1;
      background: rgba(255, 255, 255, 0.7);
      padding: 15px;
      border-radius: 50%;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .logo h1 {
      text-transform: uppercase;
      font-size: 30px;
      margin-top: 15px;
      color: #0288d1;
      font-weight: 600;
    }

    .logo h4 {
      font-size: 18px;
      margin-bottom: 15px;
      color: #00334e;
      font-weight: 600;
    }

    .logo h5 {
      text-transform: uppercase;
      font-size: 15px;
      color: #00334e;
      font-weight: 600;
    }

    .input-group {
      margin-bottom: 20px;
      text-align: left;
    }

    .input-group label {
      display: block;
      margin-bottom: 8px;
      font-weight: 500;
      color: #0a6ea3;
    }

    .input-field {
      width: 100%;
      padding: 15px 20px;
      border: none;
      border-radius: 50px;
      background: rgba(255, 255, 255, 0.7);
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
      font-size: 16px;
      transition: all 0.3s ease;
      outline: none;
    }

    .input-field:focus {
      background: rgba(255, 255, 255, 0.9);
      box-shadow: 0 4px 15px rgba(2, 136, 209, 0.2);
    }

    .input-field::placeholder {
      color: #90a4ae;
    }

    .input-icon {
      position: relative;
    }

    .input-icon i {
      position: absolute;
      right: 20px;
      top: 50%;
      transform: translateY(-50%);
      color: #0288d1;
    }

    .login-btn {
      width: 100%;
      padding: 15px;
      border: none;
      border-radius: 50px;
      background: linear-gradient(135deg, #0288d1, #01579b);
      color: white;
      font-size: 16px;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
      box-shadow: 0 4px 15px rgba(2, 136, 209, 0.3);
    }

    .login-btn:hover {
      background: linear-gradient(135deg, #0277bd, #014c7c);
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(2, 136, 209, 0.4);
    }

    .login-btn:active {
      transform: translateY(0);
    }

    @media (max-width: 480px) {
      .login-card {
        padding: 30px 20px;
      }

      .logo i {
        font-size: 40px;
        padding: 12px;
      }

      .logo h1 {
        font-size: 20px;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="login-card">
      <div class="logo">      
      <table width="100%">
        <tr>
          <td width="50%"><img width="120px" src="./_asset/img/logo_brebes.png"></td>
          <td width="50%"><img width="120px" src="<?php echo base_url($pengaturan->url_logo_kecil) ?>"></td>
        </tr>
      </table>        
        <h1><?php echo $pengaturan->nama ?></h1>
        <h4><?php echo $pengaturan->singkatan ?></h4>
      </div>

      <form action="<?php echo base_url('login/proses_login') ?>" method="POST" id="form-data">
        <p style="color: red" id="notifikasi"></p> 
        <div class="input-group">
          <label for="username">Username</label>
          <div class="input-icon">
            <input type="text" name="username" class="input-field" placeholder="Masukkan username" required>
            <i class="fas fa-user"></i>
          </div>
        </div>

        <div class="input-group">
          <label for="password">Password</label>
          <div class="input-icon">
            <input type="password" name="password" class="input-field" placeholder="Masukkan password" required>
            <i class="fas fa-lock"></i>
          </div>
        </div>
        <button type="submit" class="login-btn">Masuk</button>
      </form>
    </div>
  </div>

  <script src="./_asset/theme_lte3/plugins/jquery/jquery.min.js"></script>

  <script>
    var base_url = '<?php echo base_url(); ?>';
  </script>

  <script type="text/javascript">

    var base_url = '<?php echo base_url(); ?>';
    $('#form-data').submit(function(e){
      e.preventDefault();      
      var data = $(this).serialize();
      $('.add_data').attr('disabled', true);
      $.ajax({
        type: $('#form-data').attr('method'),
        url: $('#form-data').attr('action'),
        data: data,
        dataType:'json',
        success: function(response){
          if(response.eror == 'success'){             
            $('#notifikasi').html(response.pesan);   
            window.location.href = base_url;     
          } else {
            $('#notifikasi').html(response.pesan);          
            $('.add_data').attr('disabled', false);
          }
        },
        error: function (xhr, ajaxOptions, thrownError) { 
         console.log(xhr.responseText);
         $('.add_data').attr('disabled', false);
       }  
     });
    })
  </script>
</body>
</html>