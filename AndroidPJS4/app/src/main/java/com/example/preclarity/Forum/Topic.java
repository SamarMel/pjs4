package com.example.preclarity.Forum;

public class Topic {
    private int id;
    private String sujet;
    private String auteur;
    private String date;
    private String imageProfil;
    private String content;

    public Topic(int i, String s, String a, String d, String p, String c){
        id=i;
        sujet =s;
        auteur = a;
        date = d;
        imageProfil = p;
        content = c;
    }

    public String getSujet(){return sujet;}
    public String getAuteur(){return auteur;}
    public String getDate(){return date;}
    public int getId(){return id;}
    public String getContentTopic(){return content;}
    public String getImageProfil(){return imageProfil;}
}
