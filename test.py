f = open("texte_test.txt", 'rU')

for ligne in f :
    phrase = ligne.split()
    print phrase
    print len(phrase)
    for i in range(0,len(phrase)):
        print phrase[i]
        if phrase[i] == "moche":
            print "ce mot est interdit : '%s'. Il faut revoir votre message" % phrase[i]
            return 1
return 0
