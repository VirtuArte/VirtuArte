//------------------------------------------------------------------------------
// <auto-generated>
//     This code was generated from a template.
//
//     Manual changes to this file may cause unexpected behavior in your application.
//     Manual changes to this file will be overwritten if the code is regenerated.
// </auto-generated>
//------------------------------------------------------------------------------

namespace VirtuArte.Models
{
    using System;
    using System.Collections.Generic;
    
    public partial class organizacao
    {
        public Nullable<int> pontuacao { get; set; }
        public int id_organizacao { get; set; }
        public string descricao { get; set; }
        public Nullable<decimal> valor { get; set; }
        public int fk_usuario_id_usuario { get; set; }
        public Nullable<int> fk_endereco_id_endereco { get; set; }
    
        public virtual endereco endereco { get; set; }
        public virtual usuario usuario { get; set; }
    }
}