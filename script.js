function validateForm() {
    // Get the form inputs
    var id = document.forms["registration-form"]["id"].value;
    var firstName = document.forms["registration-form"]["firstName"].value;
    var lastName = document.forms["registration-form"]["lastName"].value;
    var projectTitle = document.forms["registration-form"]["projectTitle"].value;
    var email = document.forms["registration-form"]["email"].value;
    var phoneNumber = document.forms["registration-form"]["phoneNumber"].value;
    var timeSlot = document.forms["registration-form"]["timeSlot"].value;
  
    // Define regular expressions for validation
    var idRegex = /^\d{4}$/;
    var nameRegex = /^[a-zA-Z ]+$/;
    var projectTitleRegex = /^[a-zA-Z0-9 ]+$/;
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    var phoneRegex = /^\d{10}$/;
  
    // Validate inputs
    if (!idRegex.test(id)) {
      alert("Invalid ID. Please enter a 4-digit number.");
      return;
    }
}

// Get the number of available seats for each time slot from the server
fetch('./seats.json')
  .then(response => response.json())
  .then(data => {
    const morningSeats = data.morning;
    const afternoonSeats = data.afternoon;
    const eveningSeats = data.evening;

    // Update the table with the number of available seats
    document.getElementById('morning-seats').textContent = morningSeats;
    document.getElementById('afternoon-seats').textContent = afternoonSeats;
    document.getElementById('evening-seats').textContent = eveningSeats;

    // Block fully booked time slots
    if (morningSeats === 0) {
      document.querySelector('option[value=morning]').disabled = true;
    }
    if (afternoonSeats === 0) {
      document.querySelector('option[value=afternoon]').disabled = true;
      }
      if (eveningSeats === 0) {
      document.querySelector('option[value=evening]').disabled = true;
      }
      })
      .catch(error => {
      console.error('Error fetching seats data:', error);
      });
      
      // Handle form submission
      const form = document.querySelector('form');
      form.addEventListener('submit', event => {
      event.preventDefault();
      
      // Get form data
      const formData = new FormData(form);
      const id = formData.get('id');
      const firstName = formData.get('first_name');
      const lastName = formData.get('last_name');
      const projectTitle = formData.get('project_title');
      const email = formData.get('email');
      const phoneNumber = formData.get('phone_number');
      const timeSlot = formData.get('time_slot');
      
      // Check if student has already registered
      fetch('./students.json')
      .then(response => response.json())
      .then(data => {
      const registeredStudents = data.students;
      const isRegistered = registeredStudents.some(student => student.id === id);
      if (isRegistered) {
        alert('You have already registered for WebTech');
      } else {
        // Register student
        fetch('./register.php', {
          method: 'POST',
          body: JSON.stringify({
            id: id,
            first_name: firstName,
            last_name: lastName,
            project_title: projectTitle,
            email: email,
            phone_number: phoneNumber,
            time_slot: timeSlot
          }),
          headers: {
            'Content-Type': 'application/json'
          }
        })
          .then(response => response.json())
          .then(data => {
            alert(data.message);
          })
          .catch(error => {
            console.error('Error registering student:', error);
          });
      }
    })
    .catch(error => {
      console.error('Error fetching registered students:', error);
    });
  });
