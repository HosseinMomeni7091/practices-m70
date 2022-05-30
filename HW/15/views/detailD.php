<?php

use core\Application;

// echo '<pre>';
// print_r($user);
// echo '</pre>' . '<br>';

?>


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

            <button type="button" class="w-24 font-bold text-red-700" disabled>on</button>

          <?php } ?>
        </td>
        <td>
          <?php if ($value["9-10"] == 0) { ?>
            <button type="button" class="w-24" disabled>Off</button>
          <?php } elseif ($value["9-10"] == "reserved") { ?>
            <button type="button" class="w-24" disabled>Reserved</button>
          <?php } elseif ($value["9-10"] == 1) { ?>
            <button type="button" class="w-24 font-bold text-red-700" disabled>on</button>
          <?php } ?>
        </td>
        <td>
          <?php if ($value["10-11"] == 0) { ?>
            <button type="button" class="w-24" disabled>Off</button>
          <?php } elseif ($value["10-11"] == "reserved") { ?>
            <button type="button" class="font-bold text-gray-800 w-24" disabled>Reserved</button>
          <?php } elseif ($value["10-11"] == 1) { ?>
            <button type="button" class="w-24 font-bold text-red-700" disabled>on</button>
          <?php } ?>
        </td>
        <td>
          <?php if ($value["11-12"] == 0) { ?>
            <button type="button" class="w-24" disabled>Off</button>
          <?php } elseif ($value["11-12"] == "reserved") { ?>
            <button type="button" class="w-24" disabled>Reserved</button>
          <?php } elseif ($value["11-12"] == 1) { ?>
            <button type="button" class="w-24 font-bold text-red-700" disabled>on</button>
          <?php } ?>
        </td>
        <td>
          <?php if ($value["12-13"] == 0) { ?>
            <button type="button" class="w-24" disabled>Off</button>
          <?php } elseif ($value["12-13"] == "reserved") { ?>
            <button type="button" class="w-24" disabled>Reserved</button>
          <?php } elseif ($value["12-13"] == 1) { ?>
            <button type="button" class="w-24 font-bold text-red-700" disabled>on</button>
          <?php } ?>
        </td>
        <td>
          <?php if ($value["13-14"] == 0) { ?>
            <button type="button" class="w-24" disabled>Off</button>
          <?php } elseif ($value["13-14"] == "reserved") { ?>
            <button type="button" class="w-24" disabled>Reserved</button>
          <?php } elseif ($value["13-14"] == 1) { ?>
            <button type="button" class="w-24 font-bold text-red-700" disabled>on</button>
          <?php } ?>
        </td>
        <td>
          <?php if ($value["14-15"] == 0) { ?>
            <button type="button" class="w-24" disabled>Off</button>
          <?php } elseif ($value["14-15"] == "reserved") { ?>
            <button type="button" class="w-24" disabled>Reserved</button>
          <?php } elseif ($value["14-15"] == 1) { ?>
            <button type="button" class="w-24 font-bold text-red-700" disabled>on</button>
          <?php } ?>
        </td>
        <td>
          <?php if ($value["15-16"] == 0) { ?>
            <button type="button" class="w-24" disabled>Off</button>
          <?php } elseif ($value["15-16"] == "reserved") { ?>
            <button type="button" class="w-24" disabled>Reserved</button>
          <?php } elseif ($value["15-16"] == 1) { ?>
            <button type="button" class="w-24 font-bold text-red-700" disabled>on</button>
          <?php } ?>
        </td>
        <td>
          <?php if ($value["16-17"] == 0) { ?>
            <button type="button" class="w-24" disabled>Off</button>
          <?php } elseif ($value["16-17"] == "reserved") { ?>
            <button type="button" class="w-24" disabled>Reserved</button>
          <?php } elseif ($value["16-17"] == 1) { ?>
            <button type="button" class="w-24 font-bold text-red-700" disabled>on</button>
          <?php } ?>
        </td>
        <td>
          <?php if ($value["17-18"] == 0) { ?>
            <button type="button" class="w-24" disabled>Off</button>
          <?php } elseif ($value["17-18"] == "reserved") { ?>
            <button type="button" class="w-24" disabled>Reserved</button>
          <?php } elseif ($value["17-18"] == 1) { ?>
            <button type="button" class="w-24 font-bold text-red-700" disabled>on</button>
          <?php } ?>
        </td>

      </tr>
    <?php } ?>
  </table>

<?php endif; ?>