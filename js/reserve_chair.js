const urlParams = new URLSearchParams(window.location.search);
const urlProductType = urlParams.get('id');
let isBusy = false;

let tickets = {
    normal: 0,
    child: 0,
    older: 0
};

function ticketValidator() {
    const normal = document.querySelector('#normal-ticket-input');
    const child = document.querySelector('#child-ticket-input');
    const older = document.querySelector('#older-ticket-input');

    if (normal.value == '' || isNaN(normal.value) || !Number.isInteger(Number(normal.value)) || normal.value < 0) {
        normal.value = 0;
    } else {
        normal.value = parseInt(normal.value);
    }

    tickets.normal = normal.value;

    if (child.value == '' || isNaN(child.value) || !Number.isInteger(Number(child.value)) || child.value < 0) {
        child.value = 0;
    } else {
        child.value = parseInt(child.value);
    }

    tickets.child = child.value;

    if (older.value == '' || isNaN(older.value) || !Number.isInteger(Number(older.value)) || older.value < 0) {
        older.value = 0;
    } else {
        older.value = parseInt(older.value);
    }

    tickets.older = older.value;
}

function addNormalTicket() {
    add_chair(currentElement, 'normal');
    const popUp = document.querySelector('#choose-chair-pop-up');
    popUp.style.pointerEvents = 'none';
    popUp.style.opacity = 0;
}

function addChildTicket() {
    add_chair(currentElement, 'child');
    const popUp = document.querySelector('#choose-chair-pop-up');
    popUp.style.pointerEvents = 'none';
    popUp.style.opacity = 0;
}

function addOlderTicket() {
    add_chair(currentElement, 'older');
    const popUp = document.querySelector('#choose-chair-pop-up');
    popUp.style.pointerEvents = 'none';
    popUp.style.opacity = 0;
}

// Variable to hold the current element
let currentElement = null;

function chooseChairPopUp(element) {
    // Update currentElement
    currentElement = element;

    // Get the position of the element relative to the viewport
    const rect = element.getBoundingClientRect();

    // Get the parent container
    const parent = element.closest('.container');
    const parentRect = parent.getBoundingClientRect();

    // Calculate the position of the element relative to the parent container
    const top = rect.top - parentRect.top;
    const left = rect.left - parentRect.left;

    const popUp = document.querySelector('#choose-chair-pop-up');
    popUp.style.opacity = 1;
    popUp.style.pointerEvents = 'auto';
    popUp.style.top = `${top}px`;
    popUp.style.left = `${left}px`;

    popUp.addEventListener('mouseleave', () => {
        popUp.style.pointerEvents = 'none';
        popUp.style.opacity = 0;

        popUp.removeEventListener('mouseleave', () => {
            popUp.style.pointerEvents = 'none';
            popUp.style.opacity = 0;
        });
    });

    const popUpNormal = popUp.querySelector('#chair-pop-up-normal');
    const popUpChild = popUp.querySelector('#chair-pop-up-child');
    const popUpOlder = popUp.querySelector('#chair-pop-up-older');

    // Ensure listeners are added correctly
    popUpNormal.removeEventListener('click', addNormalTicket);
    popUpNormal.addEventListener('click', addNormalTicket);

    popUpChild.removeEventListener('click', addChildTicket);
    popUpChild.addEventListener('click', addChildTicket);

    popUpOlder.removeEventListener('click', addOlderTicket);
    popUpOlder.addEventListener('click', addOlderTicket);
}


// Add Chair Function
function add_chair(element, typeTicket) {
    const chair_num = element.dataset.num;
    const chair_row = element.dataset.row;
    const movieName = element.dataset.name;

    if (isBusy === false) {
        isBusy = true;
        if (typeTicket !== undefined && typeTicket !== null && typeTicket !== '' && chair_row !== undefined && chair_row !== null && chair_row !== '' && chair_num !== undefined && chair_num !== null && chair_num !== '') {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    console.log(this.responseText);
                    const response = JSON.parse(this.responseText);

                    if (response['error'] === true) {
                        console.log('Place already reserved.');
                    } else {
                        element.src = response['reserved'] ? '../assets/chairs/temp_reserved_chair.png' : '../assets/chairs/non_reserved_chair.png';
                        element.onclick = function () {
                            remove_chair(element, typeTicket);
                        };

                        if (response['amountOfType'] > tickets[typeTicket]) {
                            const input = document.querySelector(`#${typeTicket}-ticket-input`);
                            input.value = response['amountOfType'];
                            tickets[typeTicket] = response['amountOfType'];

                            const totalPrice = document.querySelector('#total-price-ticket');
                            totalPrice.textContent = `€${response['amountTotalPrice']},00`;

                            const huidigeStoelen = document.querySelector('#huidige-stoelen');
                            huidigeStoelen.textContent += `Rij ${chair_row}, stoel ${chair_num} | `;

                            const totalTicketsDisplay = document.querySelector('#total-tickets');
                            totalTicketsDisplay.textContent = `\xa0\xa0 ${response['totalTicketDisplay']}`;

                            const totalTickets = document.querySelector('#total-ticket-price');
                            totalTickets.textContent = `\xa0\xa0 ${response['totalTickets']}\xa0 Ticket(s) \xa0€${response['amountTotalPrice']},00`;

                        }
                    }
                    isBusy = false;
                }
            };

            xhttp.open("GET", `../modules/Ajax/temp_insert_chair.php?chair_num=${chair_num}&chair_row=${chair_row}&type_ticket=${typeTicket}&name=${movieName}`, true);
            xhttp.send();
        }
    }
}

// Remove Chair Function
function remove_chair(element, typeTicket) {
    const chair_num = element.dataset.num;
    const chair_row = element.dataset.row;
    const movieName = element.dataset.name;

    if (isBusy === false) {
        isBusy = true;

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                // console.log(this.responseText);
                const response = JSON.parse(this.responseText);
                // console.log(response['currentChairs']);

                if (response['error'] === true) {
                    console.log('Error while removing the chair.');
                } else {
                    element.src = '../assets/chairs/non_reserved_chair.png';
                    element.onclick = function () {
                        chooseChairPopUp(element);
                    };

                    const input = document.querySelector(`#${typeTicket}-ticket-input`);
                    input.value = response['amountOfType'];
                    tickets[typeTicket] = response['amountOfType'];

                    const totalPrice = document.querySelector('#total-price-ticket')
                    totalPrice.textContent = `€${response['amountTotalPrice']},00`;

                    const huidigeStoelen = document.querySelector('#huidige-stoelen');
                    huidigeStoelen.textContent = `\xa0\xa0  ${response['currentChairs']}`;

                    const totalTicketsDisplay = document.querySelector('#total-tickets');
                    totalTicketsDisplay.textContent = `\xa0\xa0 ${response['totalTicketDisplay']}`;

                    const totalTickets = document.querySelector('#total-ticket-price');
                    totalTickets.textContent = `\xa0\xa0 ${response['totalTickets']}\xa0 Ticket(s) \xa0 €${response['amountTotalPrice']},00`;

                }
                isBusy = false;
            }
        };

        xhttp.open("GET", `../modules/Ajax/deselect_temp_chair.php?chair_num=${chair_num}&chair_row=${chair_row}&type_ticket=${typeTicket}&name=${movieName}`, true);
        xhttp.send();
    }
}

// setInterval(() => {
    
// }, 60000);