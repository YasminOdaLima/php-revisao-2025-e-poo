# Dados do primeiro cachorro
nome_cachorro_1 = "Nelson"
comida_cachorro_1 = 3
sono_cachorro_1 = False

# Dados do segundo cachorro
nome_cachorro_2 = "Jeremias"
comida_cachorro_2 = 1
sono_cachorro_2 = True

# Funções para manipular os dados
def comer(quantidade_comida):
    return quantidade_comida - 1

def dormir():
    return True

# Usando as funções
comida_cachorro_1 = comer(comida_cachorro_1)
sono_cachorro_2 = dormir()

# Exibindo os resultados no terminal
print(f"{nome_cachorro_1} agora tem {comida_cachorro_1} unidades de comida.")
print(f"{nome_cachorro_2} está com sono? {sono_cachorro_2}")