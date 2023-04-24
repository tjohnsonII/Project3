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
