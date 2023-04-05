//function to check if room is available
function isRoomAvailable($roomName, $dayOfWeek, $timeslot) {
// Sanitize input parameters
$roomName = mysqli_real_escape_string($db, $roomNumber);
$dayOfWeek = mysqli_real_escape_string($db, $dayOfWeek);
$timeslot = mysqli_real_escape_string($db, $timeslot);

// Prepare the SQL query
$query = "SELECT COUNT(*) FROM unit_room_time_day_allocation_details WHERE room_id = '$roomName'
AND weekday = '$dayOfWeek' AND time_slot_id = '$timeslot'";

// Execute the query and fetch the result
$result = mysqli_query($db, $query);
$row = mysqli_fetch_array($result);

// If the count is greater than 0, the room is already booked
if ($row[0] > 0) {
return false;
} else {
// check if the room capacity is enough for the unit
if ($room['capacity'] >= $unit['group_number']) {
// check if the unit type is Theory or ICT-Practical and allocate the room accordingly
if ($unit['unit_type'] == 'Theory' && $room['room_type'] == 'Standard') {
if (in_array($unit['unit_code'], $assigned_units)) {
continue;
}else{

// assign the unit to the timeslot, room, and day
$assignment = array(
'code' => $unit['unit_code'],
'unit' => $unit['unit_name'],
'unit_type'=> $unit['unit_type'],
'lecturer' => $unit['lecturer_id'],
'lecturer_name' => $unit['user_title']." ".$unit['user_firstname']." ".$unit['user_lastname'],
'day' => $assigned_day,
'timeslot' => $random_timeslot,
'room' => $room['room_name']
);
$unit_id = $assignment['code'];
$unit_name= $assignment['unit'];
$unit_type= $assignment['unit_type'];
$day = $assignment['day'];
$timeslot = $assignment['timeslot'];
$room = $assignment['room'];
$lec = $assignment['lecturer_name'];

// save the assignment to the CSV file
fputcsv($csv_file, array($unit_id, $unit_name,$lec, $day, $timeslot, $room));

// save the assignment to the database or elsewhere
$assignment_query = "INSERT INTO `unit_room_time_day_allocation_details`(`unit_id`,`lecturer_id`, `room_id`,
`time_slot_id`, `weekday`)
VALUES ('$unit_id','$lec','$room','$timeslot','$day')";
$assignment_results = mysqli_query($db, $assignment_query);

// add the assigned unit to the array of assigned units
$assigned_units[] = $unit['unit_code'];

// remove the assigned room from the list of available rooms
$room_index = array_search($room, $rooms);
unset($rooms[$room_index]);
// break out of the room loop
break;
}
} elseif ($unit['unit_type'] == 'ICT-Practical' && $room['room_type'] == 'ICT Labaratory') {
if (in_array($unit['unit_code'], $assigned_units)) {
continue;
}else{

// assign the unit to the timeslot, room, and day
$assignment = array(
'code' => $unit['unit_code'],
'unit' => $unit['unit_name'],
'unit_type'=> $unit['unit_type'],
'lecturer' => $unit['lecturer_id'],
'lecturer_name' => $unit['user_title']." ".$unit['user_firstname']." ".$unit['user_lastname'],
'day' => $assigned_day,
'timeslot' => $random_timeslot,
'room' => $room['room_name']
);
$unit_id = $assignment['code'];
$unit_name= $assignment['unit'];
$unit_type= $assignment['unit_type'];
$day = $assignment['day'];
$timeslot = $assignment['timeslot'];
$room = $assignment['room'];
$lec = $assignment['lecturer_name'];

// save the assignment to the CSV file
fputcsv($csv_file, array($unit_id, $unit_name,$lec, $day, $timeslot, $room));

// save the assignment to the database or elsewhere
$assignment_query = "INSERT INTO `unit_room_time_day_allocation_details`(`unit_id`,`lecturer_id`, `room_id`,
`time_slot_id`, `weekday`)
VALUES ('$unit_id','$lec','$room','$timeslot','$day')";
$assignment_results = mysqli_query($db, $assignment_query);

// add the assigned unit to the array of assigned units
$assigned_units[] = $unit['unit_code'];

// remove the assigned room from the list of available rooms
$room_index = array_search($room, $rooms);
unset($rooms[$room_index]);
// break out of the room loop
break;
}
}elseif ($unit['unit_type'] == 'ELECT-Practical' && $room['room_type'] == 'Electronics LAB') {
if (in_array($unit['unit_code'], $assigned_units)) {
continue;
}else{

// assign the unit to the timeslot, room, and day
$assignment = array(
'code' => $unit['unit_code'],
'unit' => $unit['unit_name'],
'unit_type'=> $unit['unit_type'],
'lecturer' => $unit['lecturer_id'],
'lecturer_name' => $unit['user_title']." ".$unit['user_firstname']." ".$unit['user_lastname'],
'day' => $assigned_day,
'timeslot' => $random_timeslot,
'room' => $room['room_name']
);
$unit_id = $assignment['code'];
$unit_name= $assignment['unit'];
$unit_type= $assignment['unit_type'];
$day = $assignment['day'];
$timeslot = $assignment['timeslot'];
$room = $assignment['room'];
$lec = $assignment['lecturer_name'];

// save the assignment to the CSV file
fputcsv($csv_file, array($unit_id, $unit_name,$lec, $day, $timeslot, $room));

// save the assignment to the database or elsewhere
$assignment_query = "INSERT INTO `unit_room_time_day_allocation_details`(`unit_id`,`lecturer_id`, `room_id`,
`time_slot_id`, `weekday`)
VALUES ('$unit_id','$lec','$room','$timeslot','$day')";
$assignment_results = mysqli_query($db, $assignment_query);

// add the assigned unit to the array of assigned units
$assigned_units[] = $unit['unit_code'];

// remove the assigned room from the list of available rooms
$room_index = array_search($room, $rooms);
unset($rooms[$room_index]);
// break out of the room loop
break;
}
}

}
}
}