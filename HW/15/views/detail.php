<?php

use core\Application;

// echo '<pre>';
// print_r($user);
// echo '</pre>' . '<br>';

?>

<div class="flex flex-row flex-wrap">
  <div class=" mx-4 p-2">
    <div class="">Name :</div>
    <div class=""><?php echo $user[0]["name"]; ?></div>
  </div>
  <div class=" mx-4 p-2">
    <div class="">Family :</div>
    <div class=""><?php echo $user[0]["family"]; ?></div>
  </div>
  <div class=" mx-4 p-2">
    <div class="">Age :</div>
    <div class=""><?php echo $user[0]["age"]; ?></div>
  </div>
  <div class=" mx-4 p-2">
    <div class="">Medical Licence :</div>
    <div class=""><?php echo $user[0]["medical_licence"]; ?></div>
  </div>
  <div class=" mx-4 p-2">
    <div class="">Degree :</div>
    <div class=""><?php echo $user[0]["degree"]; ?></div>
  </div>
  <div class=" mx-4 p-2">
    <div class="">Field :</div>
    <div class=""><?php echo $user[0]["working_field"]; ?></div>
  </div>
  <div class=" mx-4 p-2">
    <div class="">Exprience :</div>
    <div class=""><?php echo $user[0]["exprience"]; ?></div>
  </div>
  <div class=" mx-4 p-2">
    <div class="">University :</div>
    <div class=""><?php echo $user[0]["graduated_university"]; ?></div>
  </div>
</div>


<?php if (Application::isGuest()) : ?>

<?php else : ?>

  <?php
  // echo '<pre>';
  // print_r($time);
  // echo '</pre>' . '<br>';

  ?>

  <table>
    <tr>
      <th>Day</th>
      <th>8-9</th>
      <th>9-10</th>
      <th>10-11</th>
      <th>11-12</th>
      <th>12-13</th>
      <th>13-14</th>
      <th>14-15</th>
      <th>15-16</th>
      <th>16-17</th>
      <th>17-18</th>
    </tr>
    <?php foreach ($time as $key => $value) { ?>
    <tr>
        <td><?php echo $key;  ?></td>
        <td>
          <?php if ($value["8-9"] == 0) { ?>
            <button type="button" class="w-24" disabled>Off</button>
          <?php } elseif ($value["8-9"] == "reserved") { ?>
            <button type="button" class="w-24" disabled>Reserved</button>
          <?php } elseif ($value["8-9"] == 1) { ?>
            <form action="/reserve" method="post">
              <input type="hidden" name="day" value="<?php echo $key; ?>">
              <input type="hidden" name="time" value="<?php echo "8-9"; ?>">
              <input type="hidden" name="doctor" value="<?php echo $user[0]["user_id"]; ?>">
              <button class="font-medium text-blue-600 dark:text-blue-500 hover:underline w-24">Reserve</button>
            </form>
          <?php } ?>
        </td>
        <td>
          <?php if ($value["9-10"] == 0) { ?>
            <button type="button" class="w-24" disabled>Off</button>
          <?php } elseif ($value["9-10"] == "reserved") { ?>
            <button type="button" class="w-24" disabled>Reserved</button>
          <?php } elseif ($value["9-10"] == 1) { ?>
            <form action="/reserve" method="post">
              <input type="hidden" name="day" value="<?php echo $key; ?>">
              <input type="hidden" name="time" value="<?php echo "9-10"; ?>">
              <input type="hidden" name="doctor" value="<?php echo $user[0]["user_id"]; ?>">
              <button class="font-medium text-blue-600 dark:text-blue-500 hover:underline w-24">Reserve</button>
            </form>
          <?php } ?>
        </td>
        <td>
          <?php if ($value["10-11"] == 0) { ?>
            <button type="button" class="w-24" disabled>Off</button>
          <?php } elseif ($value["10-11"] == "reserved") { ?>
            <button type="button" class="font-bold text-gray-800 w-24" disabled>Reserved</button>
          <?php } elseif ($value["10-11"] == 1) { ?>
            <form action="/reserve" method="post">
              <input type="hidden" name="day" value="<?php echo $key; ?>">
              <input type="hidden" name="time" value="<?php echo "10-11"; ?>">
              <input type="hidden" name="doctor" value="<?php echo $user[0]["user_id"]; ?>">
              <button class="font-medium text-blue-600 dark:text-blue-500 hover:underline w-24">Reserve</button>
            </form>
          <?php } ?>
        </td>
        <td>
          <?php if ($value["11-12"] == 0) { ?>
            <button type="button" class="w-24" disabled>Off</button>
          <?php } elseif ($value["11-12"] == "reserved") { ?>
            <button type="button" class="w-24" disabled>Reserved</button>
          <?php } elseif ($value["11-12"] == 1) { ?>
            <form action="/reserve" method="post">
              <input type="hidden" name="day" value="<?php echo $key; ?>">
              <input type="hidden" name="time" value="<?php echo "11-12"; ?>">
              <input type="hidden" name="doctor" value="<?php echo $user[0]["user_id"]; ?>">
              <button class="font-medium text-blue-600 dark:text-blue-500 hover:underline w-24">Reserve</button>
            </form>
          <?php } ?>
        </td>
        <td>
          <?php if ($value["12-13"] == 0) { ?>
            <button type="button" class="w-24" disabled>Off</button>
          <?php } elseif ($value["12-13"] == "reserved") { ?>
            <button type="button" class="w-24" disabled>Reserved</button>
          <?php } elseif ($value["12-13"] == 1) { ?>
            <form action="/reserve" method="post">
              <input type="hidden" name="day" value="<?php echo $key; ?>">
              <input type="hidden" name="time" value="<?php echo "12-13"; ?>">
              <input type="hidden" name="doctor" value="<?php echo $user[0]["user_id"]; ?>">
              <button class="font-medium text-blue-600 dark:text-blue-500 hover:underline w-24">Reserve</button>
            </form>
          <?php } ?>
        </td>
        <td>
          <?php if ($value["13-14"] == 0) { ?>
            <button type="button" class="w-24" disabled>Off</button>
          <?php } elseif ($value["13-14"] == "reserved") { ?>
            <button type="button" class="w-24" disabled>Reserved</button>
          <?php } elseif ($value["13-14"] == 1) { ?>
            <form action="/reserve" method="post">
              <input type="hidden" name="day" value="<?php echo $key; ?>">
              <input type="hidden" name="time" value="<?php echo "13-14"; ?>">
              <input type="hidden" name="doctor" value="<?php echo $user[0]["user_id"]; ?>">
              <button class="font-medium text-blue-600 dark:text-blue-500 hover:underline w-24">Reserve</button>
            </form>
          <?php } ?>
        </td>
        <td>
          <?php if ($value["14-15"] == 0) { ?>
            <button type="button" class="w-24" disabled>Off</button>
          <?php } elseif ($value["14-15"] == "reserved") { ?>
            <button type="button" class="w-24" disabled>Reserved</button>
          <?php } elseif ($value["14-15"] == 1) { ?>
            <form action="/reserve" method="post">
              <input type="hidden" name="day" value="<?php echo $key; ?>">
              <input type="hidden" name="time" value="<?php echo "14-15"; ?>">
              <input type="hidden" name="doctor" value="<?php echo $user[0]["user_id"]; ?>">
              <button class="font-medium text-blue-600 dark:text-blue-500 hover:underline w-24">Reserve</button>
            </form>
          <?php } ?>
        </td>
        <td>
          <?php if ($value["15-16"] == 0) { ?>
            <button type="button" class="w-24" disabled>Off</button>
          <?php } elseif ($value["15-16"] == "reserved") { ?>
            <button type="button" class="w-24" disabled>Reserved</button>
          <?php } elseif ($value["15-16"] == 1) { ?>
            <form action="/reserve" method="post">
              <input type="hidden" name="day" value="<?php echo $key; ?>">
              <input type="hidden" name="time" value="<?php echo "15-16"; ?>">
              <input type="hidden" name="doctor" value="<?php echo $user[0]["user_id"]; ?>">
              <button class="font-medium text-blue-600 dark:text-blue-500 hover:underline w-24">Reserve</button>
            </form>
          <?php } ?>
        </td>
        <td>
          <?php if ($value["16-17"] == 0) { ?>
            <button type="button" class="w-24" disabled>Off</button>
          <?php } elseif ($value["16-17"] == "reserved") { ?>
            <button type="button" class="w-24" disabled>Reserved</button>
          <?php } elseif ($value["16-17"] == 1) { ?>
            <form action="/reserve" method="post">
              <input type="hidden" name="day" value="<?php echo $key; ?>">
              <input type="hidden" name="time" value="<?php echo "16-17"; ?>">
              <input type="hidden" name="doctor" value="<?php echo $user[0]["user_id"]; ?>">
              <button class="font-medium text-blue-600 dark:text-blue-500 hover:underline w-24">Reserve</button>
            </form>
          <?php } ?>
        </td>
        <td>
          <?php if ($value["17-18"] == 0) { ?>
            <button type="button" class="w-24" disabled>Off</button>
          <?php } elseif ($value["17-18"] == "reserved") { ?>
            <button type="button" class="w-24" disabled>Reserved</button>
          <?php } elseif ($value["17-18"] == 1) { ?>
            <form action="/reserve" method="post">
              <input type="hidden" name="day" value="<?php echo $key; ?>">
              <input type="hidden" name="time" value="<?php echo "17-18"; ?>">
              <input type="hidden" name="doctor" value="<?php echo $user[0]["user_id"]; ?>">
              <button class="font-medium text-blue-600 dark:text-blue-500 hover:underline w-24">Reserve</button>
            </form>
          <?php } ?>
        </td>

      </tr>
      <?php } ?>
  </table>

<?php endif; ?>