
    // Array of texts to cycle through
    const texts = [
        "Revolutionize your dairy business with our comprehensive milk trade services.",
        "Unlock the potential of your dairy trade with our advanced milk trade services.",
        "Experience seamless milk trade operations with our end-to-end solutionst."
    ];

    // Index to keep track of the current text
    let index = 0;

    // Function to change the text
    function changeText() {
        document.getElementById("changing-text").textContent = texts[index];
        index = (index + 1) % texts.length; // Increment index or loop back to 0
    }

    // Call the changeText function every 2 seconds (2000 milliseconds)
    setInterval(changeText, 2500);

        // Get the button element by its id
        const myButton = document.getElementById('myButton');
      
        // Set focus on the button when the page is loaded or refreshed
        myButton.focus();
      
        // Add an event listener to restore focus when the page gains focus
        window.addEventListener('focus', function() {
          myButton.focus();
        });
 
