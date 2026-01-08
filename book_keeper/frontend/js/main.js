document.addEventListener('DOMContentLoaded', () => {
  const sidebar = document.getElementById('sidebar');
  const toggle = document.getElementById('toggle');
  if (toggle && sidebar) {
    toggle.addEventListener('click', () => {
      sidebar.classList.toggle('collapsed');
    });
  }

  const authContainer = document.getElementById('authContainer');
  const goRegister = document.getElementById('goRegister');
  const goLogin = document.getElementById('goLogin');

  if (authContainer) {
    if (goRegister) {
      goRegister.addEventListener('click', e => {
        e.preventDefault();
        authContainer.classList.add('show-register');
      });
    }
    if (goLogin) {
      goLogin.addEventListener('click', e => {
        e.preventDefault();
        authContainer.classList.remove('show-register');
      });
    }
  }

  const regForm = document.getElementById('regForm');
  if (regForm) {
    regForm.addEventListener('submit', (e) => {
      const pw = regForm.querySelector('input[name="password"]').value;
      const cpw = regForm.querySelector('input[name="confirm_password"]').value;
      if (pw !== cpw) {
        e.preventDefault();
        alert('Passwords do not match');
      }
    });
  }

  const grid = document.getElementById('grid');
  if (grid) loadBooks();

  const borrowedGrid = document.getElementById('borrowedGrid');
  if (borrowedGrid) loadBorrowed();

  const returnedGrid = document.getElementById('returnedGrid');
  if (returnedGrid) loadReturned();

  const borrowForm = document.getElementById('borrowForm');
  if (borrowForm) {
    borrowForm.onsubmit = async (e) => {
      e.preventDefault();
      const fd = new FormData(borrowForm);
      const res = await fetch('../api/borrow_create.php', { method: 'POST', body: fd });
      const text = await res.text();
      alert(text);
      closeModal('borrowModal');
      loadBooks();
      loadBorrowed();
    };
  }

  const returnForm = document.getElementById('returnForm');
  if (returnForm) {
    returnForm.onsubmit = async (e) => {
      e.preventDefault();
      const fd = new FormData(returnForm);
      const res = await fetch('../api/return_update.php', { method: 'POST', body: fd });
      const text = await res.text();
      alert(text);
      closeModal('returnModal');
      loadBooks();
      loadBorrowed();
      loadReturned();
    };
  }

  const borrowDateInput = document.querySelector('#borrowForm input[name="borrowDate"]');
  if (borrowDateInput) {
    const today = new Date().toISOString().split('T')[0];
    borrowDateInput.value = today;
  }

  const returnDateInput = document.querySelector('#returnForm input[name="returnDate"]');
  if (returnDateInput) {
    const today = new Date().toISOString().split('T')[0];
    returnDateInput.value = today;
  }
});

function closeModal(id) {
  const m = document.getElementById(id);
  if (m) m.classList.add('hidden');
}

async function loadBooks() {
  const grid = document.getElementById('grid');
  const res = await fetch('../api/books_list.php');
  const books = await res.json();
  grid.innerHTML = '';

  books.forEach(b => {
    const card = document.createElement('div');
    card.className = 'card';
    card.innerHTML = `
      <img src="${b.cover}" alt="${b.title}" class="book-cover">
      <div class="book-title">${b.title}</div>
      <div class="book-author">${b.author}</div>
      <div class="card-actions">
        <button class="btn btn-red" data-action="borrow">BORROW</button>
      </div>
    `;
    card.querySelector('[data-action="borrow"]').onclick = () => openBorrow(b.id);
    grid.appendChild(card);
  });
}

function openBorrow(bookId) {
  const m = document.getElementById('borrowModal');
  m.classList.remove('hidden');
  m.querySelector('input[name="book_id"]').value = bookId;
}

function openReturn(bookId) {
  const m = document.getElementById('returnModal');
  m.classList.remove('hidden');
  m.querySelector('input[name="book_id"]').value = bookId;
}

async function loadBorrowed() {
  const grid = document.getElementById('borrowedGrid');
  const res = await fetch('../api/borrowed_list.php');
  const items = await res.json();
  grid.innerHTML = items.map(i => `
    <div class="card">
      <img src="${i.cover}" alt="${i.title}" class="book-cover">
      <div class="book-title">${i.title}</div>
      <div class="book-meta"><strong>Due:</strong> ${i.due_date}</div>
      <div class="card-actions">
        <button class="btn btn-green" onclick="openReturn(${i.id})">RETURN</button>
      </div>
    </div>`).join('');
}

async function loadReturned() {
  const grid = document.getElementById('returnedGrid');
  const res = await fetch('../api/returned_list.php');
  const items = await res.json();
  grid.innerHTML = items.map(i => `
    <div class="card">
      <img src="${i.cover}" alt="${i.title}" class="book-cover">
      <div class="book-title">${i.title}</div>
      <div><strong>Returned:</strong> ${i.return_date}</div>
    </div>`).join('');
}

document.addEventListener("DOMContentLoaded", function() {
  const form = document.getElementById("regForm");
  if (!form) return;

  form.addEventListener("submit", function(e) {
    let valid = true;
    const studentNo = form.querySelector("[name='student_no']");
    const password = form.querySelector("[name='password']");
    const confirmPassword = form.querySelector("[name='confirm_password']");

    document.getElementById("studentNoError").textContent = "";
    document.getElementById("passwordError").textContent = "";
    document.getElementById("confirmError").textContent = "";

    if (!/^\d+$/.test(studentNo.value)) {
      document.getElementById("studentNoError").textContent = "❌ Student number must contain digits only.";
      valid = false;
    }

    if (password.value.length < 8) {
      document.getElementById("passwordError").textContent = "❌ Password must be at least 8 characters.";
      valid = false;
    }

    if (password.value !== confirmPassword.value) {
      document.getElementById("confirmError").textContent = "❌ Passwords do not match.";
      valid = false;
    }

    if (!valid) {
      e.preventDefault();
    }
  });
});
