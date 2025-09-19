<style>
  .animated-button {
    position: relative;
    display: flex;
    align-items: center;
    gap: 4px;
    padding: 12px 35px;
    border: none;
    border-color: transparent;
    font-size: 16px;
    background-color: var(--base-clr);
    font-weight: 600;
    color: var(--accent-clr);
    box-shadow: 0 0 0 2px var(--accent-clr);
    cursor: pointer;
    overflow: hidden;
    transition: all 0.6s cubic-bezier(0.23, 1, 0.32, 1);
  }

  .animated-button svg {
    position: absolute;
    width: 24px;
    fill: var(--accent-clr);
    z-index: 9;
    transition: all 0.8s cubic-bezier(0.23, 1, 0.32, 1);
  }

  .animated-button .arr-1 {
    right: 16px;
  }

  .animated-button .arr-2 {
    left: -25%;
  }

  .animated-button .circle {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 20px;
    height: 20px;
    background-color: var(--accent-clr);
    border-radius: 50%;
    opacity: 0;
    transition: all 0.8s cubic-bezier(0.23, 1, 0.32, 1);
  }

  .animated-button .text {
    position: relative;
    z-index: 1;
    transform: translateX(-12px);
    transition: all 0.8s cubic-bezier(0.23, 1, 0.32, 1);
  }

  .animated-button:hover {
    box-shadow: 0 0 0 12px transparent;
    color: white;
    border-radius: 12px;
  }

  .animated-button:hover .arr-1 {
    right: -25%;
  }

  .animated-button:hover .arr-2 {
    left: 16px;
  }

  .animated-button:hover .text {
    transform: translateX(12px);
  }

  .animated-button:hover svg {
    fill: var(--text-clr);
  }

  .animated-button:active {
    scale: 0.95;
    box-shadow: 0 0 0 4px white;
  }

  .animated-button:hover .circle {
    width: 220px;
    height: 220px;
    opacity: 1;
  }
  @media (max-width: 600px) {
    .animated-button {
      padding: 7px 30px;
  }
  .arr-1,
  .arr-2{
      scale: 0.79;
  }
  .arr-2{
      margin-right: 8px;
  }
  }

</style>

<button class="animated-button">
    <svg xmlns="http://www.w3.org/2000/svg" class="arr-2" viewBox="0 0 24 24">
      <path
          d="M7.82843 10.9999L13.1924 5.63589L11.7782 4.22168L4 11.9999L11.7782 19.778L13.1924 18.3638L7.82843 12.9999H20V10.9999H7.82843Z"
      ></path>
    </svg>

  <span class="text"><?php echo isset($buttonText) ? htmlspecialchars($buttonText) : 'Default'; ?></span>
  <span class="circle"></span>
  <svg xmlns="http://www.w3.org/2000/svg" class="arr-1" viewBox="0 0 24 24">
    <path
        d="M7.82843 10.9999L13.1924 5.63589L11.7782 4.22168L4 11.9999L11.7782 19.778L13.1924 18.3638L7.82843 12.9999H20V10.9999H7.82843Z"
    ></path>
    </svg>
</button>
