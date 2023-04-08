<!DOCTYPE html>
<html>

<style>
  .my-container {
    align-items: center;
    background-color: #000;
    display: flex;
    flex-direction: column;
    justify-content: center;
    height: 100vh;
  }

  .form {
    background-color: #15172b;
    border-radius: 20px;
    box-sizing: border-box;
    height: 550px;
    padding: 20px;
    width: 40vw;
    margin-bottom: 20px;

  }

  .title {
    color: #eee;
    font-family: sans-serif;
    font-size: 36px;
    font-weight: 600;
    margin-top: 30px;
    display: flex;
    justify-content: center;
    align-items: center;
    text-align: center;
  }

  .subtitle {
    color: #eee;
    font-family: sans-serif;
    font-size: 16px;
    font-weight: 600;
    margin-top: 10px;
    display: flex;
    justify-content: center;
    align-items: center;
    text-align: center;
  }

  .input-container {
    height: 50px;
    position: relative;
    width: 100%;
  }

  .ic1 {
    margin-top: 40px;
  }

  .ic2 {
    margin-top: 30px;
  }

  .input {
    background-color: #303245;
    border-radius: 12px;
    border: 0;
    box-sizing: border-box;
    color: #eee;
    font-size: 18px;
    height: 100%;
    outline: 0;
    padding: 4px 20px 0;
    width: 100%;
  }

  .cut {
    background-color: #15172b;
    border-radius: 10px;
    height: 20px;
    left: 20px;
    position: absolute;
    top: -20px;
    transform: translateY(0);
    transition: transform 200ms;
    width: 76px;
  }

  .cut-short {
    width: 50px;
  }

  .input:focus~.cut,
  .input:not(:placeholder-shown)~.cut {
    transform: translateY(8px);
  }

  .placeholder {
    color: #65657b;
    font-family: sans-serif;
    left: 20px;
    line-height: 14px;
    pointer-events: none;
    position: absolute;

  }

  .input:focus~.placeholder,
  .input:not(:placeholder-shown)~.placeholder {
    transform: translateY(-30px) translateX(10px) scale(0.75);
  }

  .input:not(:placeholder-shown)~.placeholder {
    color: #808097;
  }

  .input:focus~.placeholder {
    color: #dc2f55;
  }

  .submit {
    background-color: #08d;
    border-radius: 12px;
    border: 0;
    box-sizing: border-box;
    color: #eee;
    cursor: pointer;
    font-size: 18px;
    height: 50px;
    margin-top: 38px;
    outline: 0;
    text-align: center;
    width: 100%;
  }

  .submit:active {
    background-color: #06b;
  }

  .center-screen {
    display: flex;
    justify-content: space-between;
    align-items: center;
    text-align: center;

  }

 
</style>

<body>
  <div class="my-container">
      <form action="" method="post" class="form">
        <div class="title">Welcome</div>
        <div class="subtitle">Let's measure distance between two location</div>
        <div class="input-container ic1">
          <input id="firstname" class="input" type="text" name="o" placeholder="Enter Origin location" required />
        </div>
        <div class="input-container ic2">
          <input id="lastname" class="input" type="text" name="d" placeholder="Enter Destination location" required />
        </div>
        <input type="submit" class="submit" value="Calculate distance & time" name="submit">

        <div style="margin-top:20px;color:white;font-family:sans-serif;">Examples:
            <div style="margin-top: 10px;">
                <span style="color:white">Origin:</span>  <span style="color:grey">andheri,mumbai</span> & &nbsp;&nbsp;
                <span style="color:white">Destination:</span> <span style="color:grey">bandra,mumbai </span>
              <div>
            <div style="margin-top: 10px;">
              <span style="color:white">Origin:</span>  <span style="color:grey">dubai</span>  & &nbsp;&nbsp;
              <span style="color:white;">Destination:</span> <span style="color:grey"> sharjah </span>
            <div>
        </div>
      </form>

      <div style="margin-top:20px;">
          <?php
          if (isset($_POST['submit'])) {
            $origin = $_POST['o'];
            $destination = $_POST['d'];
            $api = file_get_contents("https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins=" . $origin . "&destinations=" . $destination . "&key=AIzaSyBUr2pfYLHvartLrfP6Rb62pABpDuJZzY8");
            $data = json_decode($api);

          ?>


            
            <span>Distance:</span> <span style="color:grey"><?php echo ((int)$data->rows[0]->elements[0]->distance->value / 1000) . ' Km'; ?></span> ,  
            <span>Time to travel:</span> <span style="color:grey"><?php echo $data->rows[0]->elements[0]->duration->text; ?></span>
            
          <?php header("Refresh: 7");
          } ?>
      </div>
  <div>


</body>

</html>