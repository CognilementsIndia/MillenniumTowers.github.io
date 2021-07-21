

//To Download the Brochure on Submit
const brochureForm = document
            .querySelector("#brochureForm");
  
        const submitForm = document
            .querySelector("#submit-form");
  
        submitForm.addEventListener("click", () => {
  
            // Creating element to download pdf
            var element = document.createElement('a');
  
            // Setting the path to the pdf file
            element.href = 'images/Mohanlal Bishnoi Logo (1).pdf';
  
            // Name to display as download
            element.download = 'Brochure.pdf';
  
            // Adding element to the body
            document.documentElement.appendChild(element);
  
            // Above code is quivalent to
            // <a href="path to file" download="download name"/>
  
            // Trigger the file download
            element.click();
  
            // Remove the element from the body
            document.documentElement.remove(element);
  
            // Submit event, to submit the form
            brochureForm.submit();
        });

//To Open form for User details
function openForm() {
  document.getElementById("myForm").style.display = "block";
}

function closeForm() {
  document.getElementById("myForm").style.display = "none";
}



//To open Phone popup
function myFunction(){
            var popup = document.getElementById("myPopup");
            popup.classList.toggle("show");
        }

//To open Enquiry form
function openEnquiryForm() {
        document.getElementById("enquiryForm").style.display = "block";
    }

    function closeEnquiryForm() {
        document.getElementById("enquiryForm").style.display = "none";
    }
