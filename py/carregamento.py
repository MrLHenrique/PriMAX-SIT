# loader.py

import tkinter as tk
import webbrowser

# Cria a janela principal
root = tk.Tk()

# Define o título da janela
root.title('Minha Aplicação')

# Define o tamanho da janela
root.geometry('400x400')

# Cria uma barra de progresso indeterminada
progress_bar = tk.ttk.Progressbar(root, mode='indeterminate')
progress_bar.pack(pady=50)

# Atualiza a barra de progresso a cada 100 milissegundos
progress_bar.start(100)

# Abre a página HTML após 3 segundos
root.after(3000, lambda: webbrowser.open('index.html'))

# Exibe a janela
root.mainloop()