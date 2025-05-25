  <?php
  session_start();
  require_once "connect.php";
  if (isset($_SESSION['submit_status']) && isset($_SESSION['status'])) {
    $submit_status = $_SESSION['submit_status'];
    $status = $_SESSION['status'];
  }


  $select_sql = "SELECT *,DATE_FORMAT(date, '%d-%m-%Y') AS formatted_date from inout_table";
  try {
    $stmt = $conn->query($select_sql);
    $data = $stmt->fetch_all(MYSQLI_ASSOC);
  } catch (PDOException $e) {
    $e->getMessage();
  }
  $total_income = 0;
  $total_outcome = 0;
  ?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Daily Income Outcome Chart</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
      crossorigin="anonymous" />
    <link rel="stylesheet" href="style.css" />
  </head>

  <body>
    <div class="container-fluid mt-5 px-4">
      <div class="row">
        <div class="col-md-6">
          <div class="card card-body shadow p-0">
            <form action="process.php" method="post">
              <input
                type="text"
                class="btn border m-3"
                name="about"
                placeholder="Type content..." />

              <select name="type" id="" class="btn border m-3">
                <option value="Income">Income</option>
                <option value="Outcome">Outcome</option>
              </select>
              <input
                type="number"
                class="btn border m-3"
                name="amount"
                style="width: 20%"
                placeholder="Amount" />
              <input type="submit" name="submit" class="btn border m-3" />
            </form>
          </div>
        </div>
        <div class="col-md-6">
          <?php if (isset($submit_status) && $submit_status == true) { ?>
            <?php if ($status) { ?>
              <div class="alert alert-success" role="alert">
                <div class="d-flex gap-4">
                  <span><i class="fa-solid fa-circle-check icon-success"></i></span>
                  <div>Data successfully inserted.</div>
                </div>
              </div>
            <?php } else { ?>
              <div class="alert alert-danger" role="alert">
                <div class="d-flex gap-4">
                  <span><i class="fa-solid fa-circle-check icon-danger"></i></span>
                  <div>Data insert failed.</div>
                </div>
              </div>
            <?php } ?>
          <?php }
          unset($_SESSION['submit_status']);
          unset($_SESSION['status']); ?>

        </div>
      </div>
    </div>

    <div class="container-fluid px-4 mt-4 m-0">
      <div class="row">
        <div class="col-md-6">
          <div class="card card-body shadow">
            <ul class="list-group">
              <?php if (isset($data)) {

                foreach ($data as $d) { ?>
                  <li class="list-group-item d-flex justify-content-between">

                    <div class="">
                      <?php echo $d['content'] ?> <br />
                      <small class="text-muted"><?php echo $d['formatted_date'] ?></small>
                    </div>

                    <?php if ($d['type'] == 'Income') { ?>
                      <small class="text text-success fw-bold align-self-center">+ <?php echo number_format($d['amount']);
                                                                                    $total_income += $d['amount'] ?> MMK</small>
                    <?php } else { ?>
                      <small class="text text-danger fw-bold align-self-center">- <?php echo number_format($d['amount']);;
                                                                                  $total_outcome += $d['amount'] ?> MMK</small>
                    <?php } ?>
                  </li>
              <?php
                }
              } ?>
            </ul>


          </div>
        </div>
        <div class="col-md-6">
          <div class="card card-body shadow">
            <div class="d-flex justify-content-between">
              <div>
                <h4>Chart</h4>
              </div>
              <div class="">
                <small class="text-success me-5">Income : + <?php echo number_format($total_income) ?> MMK</small>
                <small class="text-danger">Outcome : - <?php echo number_format($total_outcome) ?> MMK</small>
              </div>
            </div>
            <hr class="p-0 m-0" />
            <div class="mt-3">
              <canvas id="inout"></canvas>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="script.js"></script>
  </body>

  </html>