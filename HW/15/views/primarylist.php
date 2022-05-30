<!-- search and filter -->
<div class="flex flex-row mx-4 mt-2 mb-4 p-2 backdrop-blur-md bg-zinc-700-400/30 overflow-x-auto shadow-md sm:rounded">
  <form class="mr-2" action="/search" method="post">
    <label for="">Name(doctor)</label>
    <input class="rounded-md" type="text" name="name">
    <button class="bg-blue-500 hover:bg-blue-800 rounded-md p-1 text-bold text-white">Search</button>
  </form>
  <form class="ml-32" action="/filter" method="post">
    <label for="">Specialty</label>
    <select class="w-48 rounded-md" name="specialty" id="">
      <option value="<?php echo "all"; ?>">
        All
      </option>
      <?php
      foreach ($fields as $key => $value) {
      ?>
        <option value="<?php echo $value["working_field"] ?>">
          <?php echo $value["working_field"]; ?>
        </option>
      <?php
      }
      ?>
    </select>
    <button class="bg-blue-500 hover:bg-blue-800 rounded-md p-1 text-bold text-white">Filter</button>
  </form>
</div>

<!-- results -->
<div class=" relative overflow-x-auto shadow-md sm:rounded-lg mx-4">
  <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
    <thead class="text-xs text-black uppercase  backdrop-blur-md bg-amber-400/30 ">
      <tr>
        <th scope="col" class="px-6 py-3">
          Doctor Name
        </th>
        <th scope="col" class="px-6 py-3">
          Field
        </th>
        <th scope="col" class="px-6 py-3">
          Degree
        </th>
        <th scope="col" class="px-6 py-3">
          <span class="sr-only">PAGE</span>
        </th>
      </tr>
    </thead>
    <tbody class="backdrop-blur-md bg-stone-600/30 text-black ">
      <?php
      foreach ($list as $key => $value) {
      ?>
        <tr class=" border-b dark:border-gray-700">
          <th scope="row" class="px-6 py-4 font-medium text-black whitespace-nowrap">
            <?php echo $value["name"] . "  " . $value["family"]; ?>
          </th>
          <td class="px-6 py-4">
            <?php echo $value["working_field"]; ?>
          </td>
          <td class="px-6 py-4">
            <?php echo $value["degree"]; ?>
          </td>
          <td class="px-6 py-4 text-right">
            <form action="/detail" method="post">
              <input type="hidden" name="ID" value="<?php echo $value["user_id"] ?>">
              <button class="font-medium text-blue-600 dark:text-blue-500 hover:underline">page</button>
            </form>
          </td>
        </tr>
      <?php
      }
      ?>
    </tbody>
  </table>
</div>