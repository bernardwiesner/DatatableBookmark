<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Datatable bookmark example</title>

    <link href="css/bootstrap.min.css" rel="stylesheet" />

    <script src="js/jquery-1.12.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>

</head>
<script>

$(document).ready(function () {

  var table = $('#datatable').DataTable( {
    "sDom" : 'itp',
      orderCellsTop: true
  } );

  $('#start-date, #end-date').change(function () {
    table.draw();
  });

  $('#emp_no').on("keyup change", function () {
      table.columns("#col_emp_no").search(this.value).draw();
  });
  $('#birth_date').on("keyup change",function () {
      // table.search(this.value).draw();
      table.columns("#col_birth_date").search(this.value).draw();
  });

  $('#selGender').change(function() {
    if(this.value == "All"){
      table.columns("#col_gender").search('', true, false ).draw();

    }else{
      table.columns("#col_gender").search(this.value).draw();

    }

  });
  $("#showDeletedData").change(function() {
      if(this.checked) {
        table.columns("#col_hire").search('^$', true, false ).draw();

      }else{
        table.columns("#col_hire").search('', true, false ).draw();

      }
  });

  column_index = table.column("#col_hire").index();
    //range search
    $.fn.dataTable.ext.search.push(

      function( settings, data, dataIndex ) {
        var startDate = Date.parse($('#start-date').val(), 10);
        var endDate = Date.parse( $('#end-date').val(), 10);
        var columnDate = Date.parse(data[column_index]) || 0; // use data for the age column

        if ((isNaN(startDate) && isNaN(endDate)) ||
             (isNaN(startDate) && columnDate <= endDate) ||
             (startDate <= columnDate && isNaN(endDate)) ||
             (startDate <= columnDate && columnDate <= endDate)) {
            return true;
        }
        return false;
    });


});
</script>
<body>
    <div class="container datatable-filter">
            <h2 class="text-center">jQuery DataTable example</h2>
            <div class="row">
                <div class="col-lg-6">
                    <div class="checkbox">
                        <input class="checkbox" id="showDeletedData" name="searchby-column" type="checkbox">
                        <label for="column-name"><span></span>Show deleted Data</label>
                    </div>
                </div>
                <div class="col-lg-6">
                       <label for="sel1">Select list:</label>
                       <select class="form-control" id="selGender">
                         <option id="all">All</option>
                         <option id="male">M</option>
                         <option id="female">F</option>
                       </select>
                </div>
            </div>
            <div class="row">
                <h4>Filter using 2 dates</h4>
                <div class="col-lg-6">
                        <label class="control-label">Start Date Input Field</label>
                        <input type="date" class="form-control" placeholder="Select a start date" id="start-date">
                        <label class="control-label">End Date Input Field</label>
                        <input type="date" class="form-control" placeholder="Select a end date" id="end-date">
                </div>
            <br />
            <div class="row">
                <div class="col-lg-12">
                  <form  method="post">
                    <table id="datatable" class="table table-striped">
                        <thead>
                            <tr>
                                <th id="col_emp_no">Emp No</th>
                                <th id="col_birth_date">Birth Date</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th id="col_gender">Gender</th>
                                <th id="col_hire">Hire Date</th>
                            </tr>
                            <tr>
                                <th><input id="emp_no" type="text" value="" /></th>
                                <th><input id="birth_date" value="" /></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                          <tr>
                             <td>10001</td>
                             <td></td>
                             <td>Georgi</td>
                             <td>Facello</td>
                             <td>M</td>
                             <td>1986-06-26</td>
                           </tr>
                           <tr>
                             <td>10002</td>
                             <td>1964-06-02</td>
                             <td>Bezalel</td>
                             <td>Simmel</td>
                             <td>F</td>
                             <td>1985-11-21</td>
                           </tr>
                           <tr>
                             <td>10003</td>
                             <td>1959-12-03</td>
                             <td>Parto</td>
                             <td>Bamford</td>
                             <td>M</td>
                             <td>1986-08-28</td>
                           </tr>
                          <tr>
                             <td>10004</td>
                             <td>1954-05-01</td>
                             <td>Chirstian</td>
                             <td>Koblick</td>
                             <td>M</td>
                             <td></td>
                           </tr>
                          <tr>
                             <td>10005</td>
                             <td>1955-01-21</td>
                             <td>Kyoichi</td>
                             <td>Maliniak</td>
                             <td>M</td>
                             <td>1989-09-12</td>
                           </tr>
                          <tr>
                             <td>10006</td>
                             <td>1953-04-20</td>
                             <td>Anneke</td>
                             <td>Preusig</td>
                             <td>F</td>
                             <td></td>
                           </tr>
                          <tr>
                             <td>10007</td>
                             <td>1957-05-23</td>
                             <td>Tzvetan</td>
                             <td>Zielinski</td>
                             <td>F</td>
                             <td>1989-02-10</td>
                           </tr>
                          <tr>
                             <td>10008</td>
                             <td>1958-02-19</td>
                             <td>Saniya</td>
                             <td>Kalloufi</td>
                             <td>M</td>
                             <td></td>
                           </tr>
                          <tr>
                             <td>10009</td>
                             <td>1952-04-19</td>
                             <td>Sumant</td>
                             <td>Peac</td>
                             <td>F</td>
                             <td>1985-02-18</td>
                           </tr>
                          <tr>
                             <td>10010</td>
                             <td>1963-06-01</td>
                             <td>Duangkaew</td>
                             <td>Piveteau</td>
                             <td>F</td>
                             <td>1989-08-24</td>
                           </tr>
                          <tr>
                             <td>10011</td>
                             <td>1953-11-07</td>
                             <td>Mary</td>
                             <td>Sluis</td>
                             <td>F</td>
                             <td>1990-01-22</td>
                           </tr>
                          <tr>
                             <td>10012</td>
                             <td>1960-10-04</td>
                             <td>Patricio</td>
                             <td>Bridgland</td>
                             <td>M</td>
                             <td>1992-12-18</td>
                           </tr>
                          <tr>
                             <td>10013</td>
                             <td>1963-06-07</td>
                             <td>Eberhardt</td>
                             <td>Terkki</td>
                             <td>M</td>
                             <td>1985-10-20</td>
                           </tr>
                        </tbody>
                      </table>
                  </form>
                </div>
            </div>
    </div>
  </div>
</body>
<script src="js/BookmarkPlugin.js"></script>

</html>
