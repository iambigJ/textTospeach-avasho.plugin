const buttons = document.querySelectorAll('.components-button');

// Function to be executed when the button is clicked
function handleButtonClick(event) {
	// Your code here to handle the button click event
	alert('Button Clicked!');
}

// Add event listener to each button
buttons.forEach(button => {
	button.addEventListener('click', handleButtonClick);
});