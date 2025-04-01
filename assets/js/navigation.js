/**
 * File navigation.js.
 *
 * Handles the mobile navigation menu and accessibility for the navigation menu.
 */
document.addEventListener('DOMContentLoaded', function() {
  const menuToggle = document.querySelector('.mobile-menu-toggle');
  const navigation = document.querySelector('.main-navigation');
  
  if (menuToggle && navigation) {
    // Toggle mobile menu
    menuToggle.addEventListener('click', function() {
      const expanded = menuToggle.getAttribute('aria-expanded') === 'true' || false;
      
      menuToggle.setAttribute('aria-expanded', !expanded);
      navigation.classList.toggle('active');
    });
    
    // Accessibility for sub-menus
    const subMenuParents = navigation.querySelectorAll('li.menu-item-has-children');
    
    subMenuParents.forEach(function(parent) {
      const link = parent.querySelector('a');
      const subMenu = parent.querySelector('.sub-menu');
      
      if (link && subMenu) {
        // Create expand button
        const expandBtn = document.createElement('button');
        expandBtn.classList.add('submenu-expand');
        expandBtn.setAttribute('aria-expanded', 'false');
        expandBtn.setAttribute('aria-label', 'Expand child menu');
        expandBtn.innerHTML = '<span class="screen-reader-text">Expand</span>';
        
        link.after(expandBtn);
        
        // Toggle sub-menu
        expandBtn.addEventListener('click', function(e) {
          e.preventDefault();
          const expanded = expandBtn.getAttribute('aria-expanded') === 'true' || false;
          
          expandBtn.setAttribute('aria-expanded', !expanded);
          subMenu.classList.toggle('toggled-on');
        });
      }
    });
  }
});
