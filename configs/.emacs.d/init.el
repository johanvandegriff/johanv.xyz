;disable welcome screen
(setq inhibit-startup-screen t)

;disable scratch message
(setq initial-scratch-message "")

;start in text mode
(setq initial-major-mode 'text-mode)

;disable backup
(setq backup-inhibited t)
;disable auto save
(setq auto-save-default nil)

;set default dir for opening files
(setq default-directory "/DATA/")

;use "C-x C-m" or "C-c C-m" as "M-x"
(global-set-key "\C-x\C-m" 'execute-extended-command)
;(global-set-key "\C-c\C-m" 'execute-extended-command)

;kill the previous word, whitespace group, or char
;(defun backward-kill-char-or-word ()
;  (interactive)
;  (cond 
;   ((looking-back (rx (char word)) 1)
;    (backward-kill-word 1))
;   ((looking-back (rx (char blank)) 1)
;    (delete-horizontal-space t))
;   (t
;    (backward-delete-char 1))))

;Control-Backspace kills a word using the custom function above
;(global-set-key (kbd "<C-backspace>") 'backward-kill-char-or-word)

;C-w used to be kill-region, so it is reassigned to C-x C-k
;(global-set-key "\C-x\C-k" 'kill-region)
;(global-set-key "\C-c\C-k" 'kill-region)

;C-x C-k was edit-kbd-macro, so it is moved to C-x C-a
;(global-set-key "\C-x\C-a" 'edit-kbd-macro)

;disable scroll bar, tool bar, and menu bar
;(if (fboundp 'scroll-bar-mode) (scroll-bar-mode -1))
(if (fboundp 'tool-bar-mode) (tool-bar-mode -1))
(if (fboundp 'menu-bar-mode) (menu-bar-mode -1))

;use M-r and M-s for regex search
(global-set-key "\M-r" 'isearch-backward-regexp)
(global-set-key "\M-s" 'isearch-forward-regexp)

;abbreviations for the M-x menu
(defalias 'qrr 'query-replace-regexp)
(defalias 'lml 'list-matching-lines)
