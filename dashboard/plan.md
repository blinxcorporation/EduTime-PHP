To generate a timetable, you will need to allocate units to timeslots, rooms, and weekdays while ensuring that lecturers are not assigned more than one unit at the same timeslot and day, and that rooms are not assigned more than one unit at the same timeslot and day.

Here are the steps you can take to achieve this:

- Create an array of timeslots: Create an array of timeslots for each day of the week. The number of timeslots per day will depend on the time interval you want to use for each timeslot. For example, if you want to use 1-hour time intervals, you could create an array of 8 timeslots for each day from 8 am to 4 pm.

- Create an array of rooms: Create an array of rooms that includes all the standard and laboratory rooms available. You may also want to include the capacity of each room so that you can assign units to rooms that can accommodate the required number of students.

- Assign units to timeslots: Loop through each unit and assign it to a timeslot, room, and day. To do this, you can start by assigning the first unit to the first timeslot, and then move to the next timeslot, room, and day for the next unit until all units have been assigned. You may want to shuffle the order of the units to avoid assigning units to the same timeslot and day.

- Check lecturer availability: Before assigning a unit to a timeslot, room, and day, you need to check if the lecturer assigned to the unit is available at that time. You can do this by checking if the lecturer has already been assigned another unit at the same timeslot and day. If the lecturer is not available, you can move to the next timeslot, room, and day.

- Check room availability: Before assigning a unit to a timeslot, room, and day, you also need to check if the room is available at that time. You can do this by checking if the room has already been assigned another unit at the same timeslot and day. If the room is not available, you can move to the next timeslot, room, and day.

- Assign unit to timeslot and room: If the lecturer and room are available, you can assign the unit to the timeslot and room.

- Repeat until all units have been assigned: Repeat steps 3 to 6 until all units have been assigned to a timeslot and room.

- Output the timetable: Once all units have been assigned, you can output the timetable to a file or display it on the screen. The timetable should show the day, timeslot, room, unit, lecturer, and any other relevant information.
