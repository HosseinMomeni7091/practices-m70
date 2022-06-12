<div class="mx-auto">
    <div class="ml-48 font-extrabold">
        Your Reservation List
    </div>

    <div>
        <table class="ml-48">
            <tr class="text-l font-bold">
                <th class="ml-4">No.</th>
                <th class="ml-4">Patient</th>
                <th class="ml-4">Day</th>
                <th class="ml-4">Time</th>
            </tr>
            <?php foreach ($allreserve as $key => $value) {  ?>
                <tr>
                    <td class="ml-4"><?php echo $key + 1;  ?></td>
                    <td class="ml-4"><?php echo $value["name"];  ?></td>
                    <td class="ml-4"><?php echo $value["day"];  ?></td>
                    <td class="ml-4"><?php echo $value["time"];  ?></td>
                </tr>
            <?php  } ?>

        </table>

    </div>
</div>