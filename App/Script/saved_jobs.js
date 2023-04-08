const totalPages = 10;
const pagination = document.querySelector('.pagination');

for (let i = 1; i <= totalPages; i++) {
    const li = document.createElement('li');
    const link = document.createElement('a');
    link.href = `#${i}`;
    link.textContent = i;
    li.appendChild(link);
    pagination.appendChild(li);
  }

const currentUrl = window.location.href;
const currentPage = parseInt(currentUrl.split('#')[1]);

const links = document.querySelectorAll('.pagination a');
links.forEach(link => {
  const pageNum = parseInt(link.textContent);
  if (pageNum === currentPage) {
    link.classList.add('active');
  }
});