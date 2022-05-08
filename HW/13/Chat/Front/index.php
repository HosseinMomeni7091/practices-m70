<?php
include "../assets/filesystem.php";
include_once "../Storage/DB/DatabaseConnectionInterface.php";
include_once "../Storage/DB/MySqlDatabaseConnection.php";
include_once "../Storage/DB/DatabaseInterface.php";
include_once "../Storage/DB/MySqlDatabase.php";
$username = $_COOKIE["username"];

//storage method
$StorageMethod = json_decode(read_file("config.json"), true);
if ($StorageMethod["Save_mode"] == "DB") {
  $connection = MySqlDatabaseConnection::getInstance();
  $pdo1 = $connection->getConnection('localhost', 'root', '', 'chatroom');

  // users info---------------------
  $stmt = $pdo1->prepare("SELECT * FROM Profile_images right JOIN Users on Users.username = Profile_images.username;");
  $stmt->execute();
  $userjsonarray0 = $stmt->fetchAll();

  $userjsonarray = [];
  $temp_comparison = "1";
  foreach ($userjsonarray0 as $key => $value) {
    if ($value["username"] != $temp_comparison) {
      $temp_comparison = $value["username"];
      $userjsonarray[$value["username"]] = $value;
      $userjsonarray[$value["username"]]["other_profile_image"] = [];
      $userjsonarray[$value["username"]]["other_profile_image"][] = $value["other_profile_image"];
    } else {
      $temp_comparison = $value["username"];
      $userjsonarray[$value["username"]]["other_profile_image"][] = $value["other_profile_image"];
    }
  }

  echo '<pre>****Koll user  ghabl***';
  print_r($userjsonarray0);
  echo '</pre>' . '<br>';
  echo '<pre>****Koll user  bad***';
  print_r($userjsonarray);
  echo '</pre>' . '<br>';


  // current user info---------------------
  $stmt = $pdo1->prepare("SELECT * FROM Users WHERE username=:id");
  $stmt->execute(["id" => $username]);
  $userjsonarray1 = $stmt->fetchAll();
  echo '<pre>**** karbar ghabl******';
  print_r($userjsonarray1);
  echo '</pre>' . '<br>';
  $jsoncurrentname = $userjsonarray1[0]["name"];
  $jsoncurrentbio = $userjsonarray1[0]["bio"];
  $jsoncurrentpermission = $userjsonarray1[0]["permission"];
  $jsoncurrentmainpicture = $userjsonarray1[0]["main_profile_image"];
  echo '<pre>**** karbar bad******';
  print_r($jsoncurrentmainpicture);
  echo '</pre>' . '<br>';

  // user images---------------------
  $stmt2 = $pdo1->prepare("SELECT Profile_images.image_id, Profile_images.other_profile_image FROM Users JOIN Profile_images on Users.username=Profile_images.username WHERE Users.username=:id");
  $stmt2->execute(["id" => $username]);
  $userjsonarray2 = $stmt2->fetchAll();
  $userjsonarray3 = [];
  foreach ($userjsonarray2 as $key => $value) {
    $userjsonarray3[$value["image_id"]] = $value["other_profile_image"];
  }
  $jsoncurrenttotalpicture = $userjsonarray3;
  echo '<pre>';
  print_r($jsoncurrenttotalpicture);
  echo '</pre>' . '<br>';

  // user chat and seen status---------------------
  $stmt3 = $pdo1->prepare("SELECT * FROM(( Users JOIN Chatroom on Users.username=Chatroom.username) left join SeenStatus on Chatroom.massage_id=SeenStatus.massage_id)");
  $stmt3->execute();
  $totalchat0 = $stmt3->fetchAll();
  echo '<pre>***chat ghabe Amade shadan***';
  print_r($totalchat0);
  echo '</pre>' . '<br>';
  $totalchat = [];
  $stick=0;
  foreach ($totalchat0 as $key => $value) {
    echo "key :".$key."</br>";
    echo '<pre>val:';
    print_r($value);
    echo '</pre>'.'<br>';
    echo "username :".$totalchat0[$key]["username"]."</br>";
    echo "massage :".$totalchat0[$key]["massage"]."</br>";
    if ($key=="0"){
      $totalchat[$key] = [
        "username" => $value["username"],
        "massage" => $value["massage"],
        "seen_by" => [$value["user_id"]]
      ];
      echo '<pre>';
      print_r($totalchat[$key]);
      echo '</pre>'.'<br>';
    }else{
      if (($totalchat0[$key]["username"]==$totalchat0[$key-1]["username"])&&($totalchat0[$key]["massage"]==$totalchat0[$key-1]["massage"])) {
        $totalchat[$stick]["seen_by"][] = $value["user_id"];
        echo "Stick ::".$stick.'<br>';
        echo '<pre>';
        print_r($totalchat[$stick]);
        echo '</pre>'.'<br>';
      } else {
        $stick=$key;
        echo "Stick ::".$stick.'<br>';
        $totalchat[$key] = [
          "username" => $value["username"],
          "massage" => $value["massage"],
          "seen_by" => [$value["user_id"]]
        ];
        echo '<pre>';
        print_r($totalchat[$key]);
        echo '</pre>'.'<br>';
      }
    }
    
  }
  echo '<pre>******chat bade amade shodan*****';
  print_r($totalchat);
  echo '</pre>' . '<br>';
} else {
  // user info ------------------------
  echo "json mode";
  $userjsonarray = json_decode(read_file("users.json"), true);
  echo '<pre>';
  print_r($userjsonarray);
  echo '</pre>' . '<br>';
  $jsoncurrentname = $userjsonarray[$username]["name"];
  $jsoncurrentbio = $userjsonarray[$username]["bio"];
  $jsoncurrentpermission = $userjsonarray[$username]["permission"];
  $jsoncurrentmainpicture = $userjsonarray[$username]["main_profile_image"];
  $jsoncurrenttotalpicture = $userjsonarray[$username]["other_profile_image"];
  // total chat ------------------------
  $totalchat = json_decode(read_file('chatroom.json'), true);
}



?>
<!-- Prepare the data -->
<?php
// $userjsonarray = json_decode(read_file("users.json"), true);
// $jsoncurrentname = $userjsonarray[$username]["name"];
// $jsoncurrentbio = $userjsonarray[$username]["bio"];
// $jsoncurrentpermission = $userjsonarray[$username]["permission"];
// $jsoncurrentmainpicture = $userjsonarray[$username]["main_profile_image"];
// $jsoncurrenttotalpicture = $userjsonarray[$username]["other_profile_image"];
echo "1";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="../dist/output.css" rel="stylesheet">
  <Style>
    .textinput {
      width: 80px;
      margin-top: 5px;

    }

    .chatroomclass {
      border: 1px solid black;
      border-radius: 4px;
      width: 700px;
      height: 300px;
      overflow: scroll;
      padding: 20px;
    }

    .iamgeinchat {
      width: 200px;
      height: 200px;

    }

    .modal {
      transition: opacity 0.25s ease;
    }

    body.modal-active {
      overflow-x: hidden;
      overflow-y: visible !important;
    }
  </Style>
  <title>Document</title>
</head>

<body>
  <!--Modal-->
  <div class="modal opacity-0 pointer-events-none fixed w-full h-full top-0 left-0 flex items-center justify-center">
    <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>

    <div class="modal-container bg-white w-11/12 max-w-2xl mx-auto rounded shadow-lg z-50 overflow-y-auto">

      <!-- ESC button -->
      <div class="modal-close absolute top-0 right-0 cursor-pointer flex flex-col items-center mt-4 mr-4 text-white text-sm z-50">
        <svg class="fill-current text-white" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
          <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
        </svg>
        <span class="text-sm">(Esc)</span>
      </div>

      <!-- Add margin if you want to see some of the overlay behind the modal-->
      <div class="modal-content py-4 text-left px-6">

        <!--Title-->
        <div class="flex justify-between items-center pb-3">
          <p class="text-xl font-bold">Hi dear <?php echo $jsoncurrentname; ?></p>
          <div class="modal-close cursor-pointer z-50">
            <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
              <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
            </svg>
          </div>
        </div>

        <!--Modal Form-->
        <form action="../Back/profile.php" method="post" enctype="multipart/form-data">
          <div class="flex flex-row flex-nowrap justify-between justify-items-center items-stretch p-2">
            <div>
              <!-- Name -->
              <label for="firstname">Your name :</label></br>
              <input type="text" name="firstname" placeholder="<?php echo $jsoncurrentname ?>"></br>

              <!-- Bio -->
              <label for="bio">Your BIO :</label></br>
              <input type="text" name="bio" placeholder="<?php echo $jsoncurrentbio ?>"></br>

              <!-- Upload file -->
              <label for="file">Upload your new picture :(max 4 pictures)</label></br>
              <?php
              // $user_jns = json_decode(read_file("users.json"), true);
              if (count($jsoncurrenttotalpicture) < 4) {
              ?>
                <input id="jprofileupload" type="file" name="file"></br>
              <?php
              } else {
              ?>
                <input id="jprofileupload" type="file" name="file" disabled title="You uploaded 4 pictures former and you can delete each items and then upload new picture"></br>
              <?php
              };
              ?>
              <!-- Send Botton -->
              <button class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-black py-2 px-4 border border-blue-800 hover:border-transparent rounded" name="submit">Update</button></br>
            </div>
            <!-- prepare main image to show -->
            <?php
            if ($jsoncurrentmainpicture == "") {
              $editedaddressmainpic = "../Storage/first.png";
            } else {
              if (is_array($jsoncurrentmainpicture)) {
                $index_of_total = $jsoncurrentmainpicture[0];
              } else {
                $index_of_total = $jsoncurrentmainpicture;
              }
              $editedaddressmainpic = preg_replace("/.*(?=\/Storage\/)/", ".", $jsoncurrenttotalpicture[$index_of_total]);
            }
            ?>
            <img class="w-72 h-72 shadow-2xl rounded-full border-solid border-2 border-indigo-600/25" src="<?php echo $editedaddressmainpic; ?>" alt="Your browser don't allowed to load from local resource">
          </div>

        </form>

        <!--User uploaded images-->
        <p>Your pictures are as bellow:</p>
        <div class="flex flex-row flex-nowrap gap-1 justify-items-center">
          <?php
          foreach ($jsoncurrenttotalpicture as $pkey => $imagesvalue) {
            $images = preg_replace("/.*(?=\/Storage\/)/", ".", $imagesvalue);
          ?>
            <div class="flex flex-col p-2 place-items-center items-center">
              <img class="w-20 h-20 border-solid border-2 border-purple-500 rounded-lg " src="<?php echo $images; ?>" alt="Your browser don't allowed to load from local resource">
              <div class="flex flex-row p-2 place-items-center items-center">
                <button id="deleteprofilepic" class="text-center text-xs font-bold border-2 bg-red-500 rounded-md p-1" onclick="jpdelete(this)" data-pindex="<?php echo $pkey; ?>">Delete</button>
                <button id="setasmain" class="text-center text-xs font-bold border-2 bg-green-500 rounded-md p-1" onclick="jpmain(this)" data-pindex="<?php echo $pkey; ?>">Main</button>
              </div>
            </div>
          <?php
          }
          ?>
        </div>
        <!--Footer-->
        <div class="flex justify-start pt-2">
          <button class="modal-close px-4 bg-indigo-500 p-3 rounded-lg text-white hover:bg-indigo-400">Close</button>
        </div>

      </div>
    </div>
  </div>

  <div class="flex justify-between gap-2 items-center">
    <div class="flex justify-start gap-2 items-center">
      <img class=" modal-open bg-transparent  w-12  h-12 rounded-full border-solid border-2 border-indigo-600" src="<?php echo $editedaddressmainpic; ?>" alt="Your browser don't allowed to load from local resource">
      <p1 class="text-3xl font-bold underline">Hi dear<?php echo " " . $jsoncurrentname; ?></p1>
    </div>
    <p class="font-bold text-center text-xl ">Momeni Chatroom</p>
  </div>

  <!-- form -->
  <form action="../Back/sendmassage.php" method="post" enctype="multipart/form-data">

    <!-- Get Message -->
    <div class="">
      <label for="">Massage</label>
      <textarea class="w-32 h-20 " id="messageinput" type="text" name="massage" maxlength="100"></textarea></br>
      <p id="limit"></p>
    </div>


    <!-- Upload file -->
    <label for="">File</label>
    <input id="jfile" type="file" name="file"></br>

    <!-- Send Botton -->
    <?php
    if ($jsoncurrentpermission != "blocked") {
    ?>
      <button class="bg-zinc-700 hover:bg-blue-500 text-blue-700 font-semibold hover:text-black py-2 px-4 border border-blue-800 hover:border-transparent rounded" name="submit">Send</button>
    <?php
    } else {
    ?>
      <button name="submit" disabled title="Unfortunately, you have been blocked by admin">Send</button>
    <?php
    }
    ?>
    </br>

  </form>
  <hr>

  <!-- The Json file has been updated for last stage -->
  <!-- Show Message -->
  <h2>Chatroom</h2>
  <div class="flex flex-row flex-nowrap">
    <!-- chatroom -->
    <div class=" w-[500px] h-[300px] overflow-scroll p-6 border-red-600 ">
      <!-- userprofile preparation -->
      <?php
      foreach ($totalchat as $key => $value) {
        $firstimage = $userjsonarray[$value["username"]]["main_profile_image"];
          if (is_array($firstimage)) {
            if (count($firstimage)==0){
              $imgprof = "../Storage/first.png";
            }else{
              $index_of_total2 = $firstimage[0];
              $imgprof = preg_replace("/.*(?=\/Storage\/)/", ".", $userjsonarray[$value["username"]]["other_profile_image"][$index_of_total2]);
            }
          } else {
            if($firstimage == ""){
              $imgprof = "../Storage/first.png";
            }else{
              $index_of_total2 = $firstimage;
              $imgprof = preg_replace("/.*(?=\/Storage\/)/", ".", $userjsonarray[$value["username"]]["other_profile_image"][$index_of_total2]);
              }
            }
      ?>
        <!-- Print User chat -->
        <!-- chatter profile print -->
        <div class="flex flex-row w-32 h-10 rounded-sm items-center gap-2 my-1">
          <div><img class="w-10  h-10 rounded-full border-solid border-2 border-indigo-600" src="<?php echo $imgprof; ?>" alt="Your browser don't allowed to load from local resource"></div>
          <div> <?php echo $value["username"] . " :"; ?> </div>
        </div>
        <!-- print chat message or image -->
        <div>
          <?php
          $number = preg_match_all("/\/upload\//", $value["massage"], $all);
          if ($number == 0) {
            echo $value["massage"];
            // Trace of seen message
            if ($value["username"] != $username) {
              if (!in_array($username, $totalchat[$key]["seen_by"])) {

                if ($StorageMethod["Save_mode"] == "DB") {

                  // search id in DB------------------------
                  $stmt9 = $pdo1->prepare("SELECT Chatroom.massage_id FROM Users JOIN Chatroom on Users.username = Chatroom.username where Users.username=? and Chatroom.massage=?;");
                  $stmt9->execute([$value["username"],$value["massage"]]);
                  $result_pdo1 = $stmt9->fetchAll();
                  $massage_id = $result_pdo1[0]["massage_id"];

                  //add user as viewer to DB------------------------
                  $stmt6 = $pdo1->prepare("INSERT INTO SeenStatus (massage_id,user_id)
                  VALUES (?,?);");
                  $stmt6->execute([$massage_id, $username]);
                  $result_pdo2 = $stmt6->fetchAll();
                } else {
                  $totalchat[$key]["seen_by"][] = $username;
                }
              }
            }
          } else {
            $chateditedaddress = preg_replace("/.*(?=\/Storage\/)/", ".", $value["massage"]);
            // Trace of seen picture


            if ($value["username"] != $username) {
              if (!in_array($username, $totalchat[$key]["seen_by"])) {
                if ($StorageMethod["Save_mode"] == "DB") {

                  // search id in DB------------------------
                  $stmt9 = $pdo1->prepare("SELECT Chatroom.massage_id FROM Users JOIN Chatroom on Users.username = Chatroom.username where Users.username=? and Chatroom.massage=?;");
                  $stmt9->execute([$value["username"],$value["massage"]]);
                  $result_pdo1 = $stmt9->fetchAll();
                  $massage_id = $result_pdo1[0]["massage_id"];

                  //add user as viewer to DB------------------------
                  $stmt6 = $pdo1->prepare("INSERT INTO SeenStatus (massage_id,user_id)
                  VALUES (?,?);");
                  $stmt6->execute([$massage_id, $username]);
                  $result_pdo2 = $stmt6->fetchAll();
                } else {
                  $totalchat[$key]["seen_by"][] = $username;
                }
              }
            }
          ?>
            <img class="w-36 h-36" src="<?php echo $chateditedaddress; ?>" alt="Your browser don't allowed to load from local resource">
          <?php
          }
          ?>
        </div>
        <!-- buttons -->
        <div class="">
          <!-- Edit -->
          <?php
          if ((($jsoncurrentpermission == "admin") || ($value["username"] == $username)) && ($number == 0)) {
          ?>
            <input class="w-18 border-red-600 border-solid" type="text" id="edittext-<?php echo $key; ?>">
            <button onclick="jedit(this)" data-index="<?php echo $key; ?>">Edit</button>

          <?php } ?>

          <!-- Seen -->
          <button onclick="jseen(this)" data-index="<?php echo $key; ?>">Seen</button>

          <!-- Delete -->
          <?php
          if (($jsoncurrentpermission == "admin") || ($value["username"] == $username)) {
          ?>
            <button onclick="jdel(this)" data-index="<?php echo $key; ?>">Delete</button>
          <?php } ?>

          <!-- Block for ever -->
          <?php
          if (($userjsonarray[$username]["permission"] == "admin") && ($value["username"] != "admin")) {
            if ($userjsonarray[$value["username"]]["permission"] == "blocked") {
          ?>
              <button onclick="junblock(this)" data-index="<?php echo $value["username"]; ?>">Unblock</button>
            <?php } else { ?>
              <button onclick="jblock(this)" data-index="<?php echo $value["username"]; ?>">Block</button>
          <?php }
          } ?>
        <?php
        echo "</br>";
        //the end of edite of chat for trace of seen message
        write_file('chatroom.json', json_encode($totalchat));
      }
        ?>
        </div>
    </div>

    <!-- seen -->
    <div class="w-[500px] h-[100px] p-6 border-red-600">
      <p>Users that seen this message are as below:</p>
      <p id="seen" class=""></p>
    </div>

  </div>




  <!-- Java Script -->
  <!-- java script source -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <!-- Java Script code -->
  <script>
    // Delete----------------------------------------
    function jdel(element) {
      console.log(element.dataset.index);
      let index = element.dataset.index;
      // Send to back
      $.ajax({
        url: "../Back/delete.php",
        method: "POST",
        data: {
          "index": index,
        },
        success: function(result) {
          alert("Deleting has been done.");
        }
      });
    };

    // Seen ----------------------------------------
    function jseen(element) {
      console.log(element.dataset.index);
      let index = element.dataset.index;
      $.getJSON('../Storage/chatroom.json', function(data) {
        console.table(data[index]["seen_by"]);
        $.each(data[index]["seen_by"], function(i, user) {
          $('#seen').append('<span>' + user + ', </span>');
        });
      });
    };
    // Edit----------------------------------------
    function jedit(element) {
      console.log(element.dataset.index);
      let index = element.dataset.index;
      let edittext = $(`#edittext-${index}`).val();
      // Send to back
      $.ajax({
        url: "../Back/edite.php",
        method: "POST",
        data: {
          "index": index,
          "edit": edittext,
        },
        success: function(result) {
          alert(" Editing has been done.");
        }
      });
    };

    // Delete images of profile----------------------------------------
    function jpdelete(element) {
      console.log(element.dataset.pindex);
      let index = element.dataset.pindex;
      // Send to back
      $.ajax({
        url: "../Back/delimg.php",
        method: "POST",
        data: {
          "index": index,
        },
        success: function(result) {
          alert(" Deleting of image of profile has been done");
        }
      });
    };

    // Edite main images of profile----------------------------------------
    function jpmain(element) {
      console.log(element.dataset.pindex);
      let index = element.dataset.pindex;
      // Send to back
      $.ajax({
        url: "../Back/mainimage.php",
        method: "POST",
        data: {
          "index": index,
        },
        success: function(result) {
          alert(" Main image of profile has been Edited");
        }
      });
    };

    // Block----------------------------------------
    function jblock(element) {
      console.log(element.dataset.index);
      let index = element.dataset.index;
      // Send to back
      $.ajax({
        url: "../Back/block.php",
        method: "POST",
        data: {
          "username_of_block": index,
        },
        success: function(result) {
          alert("Block user's command Submitted");
        }
      });
    };

    // Unblock----------------------------------------
    function junblock(element) {
      console.log(element.dataset.index);
      let index = element.dataset.index;
      // Send to back
      $.ajax({
        url: "../Back/unblock.php",
        method: "POST",
        data: {
          "username_of_unblock": index,
        },
        success: function(result) {
          alert("unblock user's command Submitted");
        }
      });
    };

    // Limit on message-----------------------------------------
    $("#messageinput").on("input", function(e) {
      if (this.value.length > 100) {
        $("#limit").text("-" + `${this.value.length - 100}`);
        $("#limit").css("color", "red");
      } else {
        $("#limit").css("color", "green");
        $("#limit").text(100 - this.value.length);
      }
    });

    //Modal page -- Profile
    // -----------------------------------------------------------
    var openmodal = document.querySelectorAll('.modal-open')
    for (var i = 0; i < openmodal.length; i++) {
      openmodal[i].addEventListener('click', function(event) {
        event.preventDefault()
        toggleModal()
      })
    }

    const overlay = document.querySelector('.modal-overlay')
    overlay.addEventListener('click', toggleModal)

    var closemodal = document.querySelectorAll('.modal-close')
    for (var i = 0; i < closemodal.length; i++) {
      closemodal[i].addEventListener('click', toggleModal)
    }

    document.onkeydown = function(evt) {
      evt = evt || window.event
      var isEscape = false
      if ("key" in evt) {
        isEscape = (evt.key === "Escape" || evt.key === "Esc")
      } else {
        isEscape = (evt.keyCode === 27)
      }
      if (isEscape && document.body.classList.contains('modal-active')) {
        toggleModal()
      }
    };


    function toggleModal() {
      const body = document.querySelector('body')
      const modal = document.querySelector('.modal')
      modal.classList.toggle('opacity-0')
      modal.classList.toggle('pointer-events-none')
      body.classList.toggle('modal-active')
    }
  </script>
</body>

</html>