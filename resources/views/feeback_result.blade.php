
@php
$experience= $_GET['op1'];
$comments= $_GET['comments'];
$bulk = new MongoDB\Driver\BulkWrite;
$id=rand(1,10000);
$document1 = ['rating' => $experience];
$document2 = ['_id' => $id, 'comments' => $comments];

$_id1 = $bulk->insert($document1);
$_id2 = $bulk->insert($document2);
echo 'Experience',$experience;
echo 'comments',$comments;
var_dump($_id1, $_id2);

$manager = new MongoDB\Driver\Manager('mongodb://localhost:27017');
$result = $manager->executeBulkWrite('bloodbank.feedback', $bulk);
@endphp
<script type="text/javascript">location.href = '/feedback-s?status=1';</script>
