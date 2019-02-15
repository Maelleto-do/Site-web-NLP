f = open("texte_test.txt", 'rU')

for ligne in f :
    mots = f.split()
    print mots[:-1]
