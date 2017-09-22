<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Wallet Balance</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>

<body>
    <div class="container">

   <table class="table table-condensed">
        <thead>
            <tr>
            <th>Wallet Id</th>
            <th>Name</th>
            <th>Balance</th>
            <th>Date Created</th>
            <th>Date Updated</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                
                @php echo $walletBalance[0]['id'] @endphp<br>

                </td>

               <td>

               @php echo $walletBalance[0]['name'] @endphp<br>
            
               </td>

               <td>
              @php echo $walletBalance[0]['currency'] @endphp @php echo $walletBalance[0]['balance'] @endphp<br>
               	
               </td>

               <td>

               @php echo $walletBalance[0]['createdAt'] @endphp<br>
               	
               </td>

               <td>

               @php echo $walletBalance[0]['updatedAt'] @endphp<br>
               	
               </td>
            </tr>
        </tbody>
    </table>
    </div>
</body>
</html>