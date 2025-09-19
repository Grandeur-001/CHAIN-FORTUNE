<style>
    /* MODAL STYLING */

    .action-modal.overlay {
        background-color: rgba(17, 18, 26, 0.8);    
        backdrop-filter: blur(8px); 
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        visibility: hidden; 
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        z-index: 9000;
    }
    .action-modal-content {
        padding: 1rem;
        background-color: var(--hover-clr);
        border-radius: 8px;
        width: 100%;
        max-width: 400px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .action-modal-header {
        padding: 14px;
        border-bottom: 1px solid var(--line-clr);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .action-modal-title {
        color: var(--text-clr);
        margin: 0;
        font-size: 1.25rem;
    }

    .action-modal-close {
        background: transparent;            
        border: none;
        color: var(--secondary-text-clr);
        font-size: 1.5rem;
        cursor: pointer;
        padding: 0;
    }

    .action-modal-body {
        padding: 10px;
        color: var(--secondary-text-clr);
    }

    .action-modal-body strong {
        color: var(--text-clr);
    }
    input[type=number] {
        -moz-appearance: textfield;
    }
    .action-modal-body input,
    .action-modal-body select,
    .action-modal-body textarea{
        background-color: var(--base-clr);
        border: 1px solid var(--line-clr);
        padding: 0.75rem 1rem;
        border-radius: 8px;
        color: var(--text-clr);
        font-size: 1rem;
        transition: all 0.3s ease;
        width: 100%;
        margin-bottom: 10px;
        margin-top: 5px;
    }
    .action-modal-body textarea{
        max-width: 100%;
        min-width: 100%;
        max-height: 200px;
        min-height: 200px;
    }
    .action-modal-body label{
        font-size: 13px;
        margin-left: 3px;
    }

    .action-modal-body input:focus,
    .action-modal-body select:focus,
    .action-modal-body textarea:focus{
        outline: none;
        border-color: var(--accent-clr);
        box-shadow: 0 0 0 4px var(--input-focus-clr);
    }


    .action-modal-footer {
        padding: 20px;
        border-top: 1px solid var(--line-clr);
        display: flex;
        justify-content: flex-end;
        gap: 10px;
    }


    .btn {
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 1rem;
        transition: background-color 0.3s ease;
    }

    .btn-secondary {
        background-color: var(--base-clr);
        color: var(--text-clr);

        &:hover{
            background: var(--negative-text-clr);
        }
    }

    .btn-primary {
        background-color: var(--accent-clr);
        color: var(--text-clr);

        &:hover {
            background-color: #4a4fff;
            box-shadow: 0 4px 12px rgba(94, 99, 255, 0.2);
        }
    }

    @media (max-width: 576px) {
        .action-modal-content{
            scale: 0.88;
        
        }
    }
    @media (max-width: 480px) {
        .action-modal-content{
            scale: 0.77;
        }
        .close-preview {
            display: flex;
            scale: 0.77;
        }
        .action-modal-content {
            max-width: 100%;
        }

        .action-modal-title {
            font-size: 1.1rem;
        }

        .action-modal-body {
            font-size: 0.9rem;
        }

        .btn {
            font-size: 0.9rem;
            padding: 8px 16px;
        }
    }

    @media (max-width: 320px) {
        .action-modal-content{
            scale: 0.87;
        }
        .action-modal-header,
        .action-modal-body,
        .action-modal-footer {
            padding: 15px;
        }

        .action-modal-footer {
            flex-direction: column;
            gap: 10px;
        }

        .btn {
            width: 100%;
        }
    }
  
</style>