package com.example.preclarity.chat;

public class Utilisateur {
    private int idU;
    private String pseudo;
    private String picture;
    private int idConv;

    public Utilisateur(int id, String p, String pic, int conv){
        idU = id;
        pseudo = p;
        picture = pic;
        idConv = conv;
    }


    public String getPseudo(){return pseudo;}
    public String getPicture(){return picture;}
    public int getIdConv(){return idConv;}
    public int getIdU(){return idU;}
}
